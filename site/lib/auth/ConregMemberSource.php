<?php

require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(__DIR__ . '/MemberSource.php');

// Finds members in a Conreg (Drupal) database over a direct MySQL connection.
// Configured by the [conreg_db] section of the secrets file; the account only
// needs SELECT on the conreg_members table.
//
// Only paid, approved members with a member number are found, and the member
// number is the badge number. A member without an email address of their own
// logs in with the email of the lead member of their group.
class ConregMemberSource implements MemberSource {
  private const EFFECTIVE_EMAIL = "COALESCE(NULLIF(TRIM(m.email), ''), lead_m.email)";

  private ?PDO $pdo = null;

  public function members_for_email(string $email): array {
    $rows = $this->query(
      "SELECT m.member_no, m.first_name, m.last_name, m.badge_name, " . self::EFFECTIVE_EMAIL . " AS email
       FROM " . $this->members_with_lead() . "
       WHERE LOWER(" . self::EFFECTIVE_EMAIL . ") = LOWER(?) AND m.eid = ? AND " . $this->member_conditions('m') . "
       ORDER BY m.member_no",
      [$email, $this->event_id()]
    );
    return array_map(fn($row) => $this->to_member($row), $rows);
  }

  public function search(string $query): array {
    $like = '%' . strtr($query, ['!' => '!!', '%' => '!%', '_' => '!_']) . '%';
    $rows = $this->query(
      "SELECT m.member_no, m.first_name, m.last_name, m.badge_name, " . self::EFFECTIVE_EMAIL . " AS email
       FROM " . $this->members_with_lead() . "
       WHERE m.eid = ? AND " . $this->member_conditions('m') . "
         AND (m.member_no = ?
           OR LOWER(m.badge_name) LIKE LOWER(?) ESCAPE '!'
           OR LOWER(CONCAT(m.first_name, ' ', m.last_name)) LIKE LOWER(?) ESCAPE '!'
           OR LOWER(" . self::EFFECTIVE_EMAIL . ") LIKE LOWER(?) ESCAPE '!')
       ORDER BY m.member_no
       LIMIT " . MEMBER_SOURCE_SEARCH_LIMIT,
      [$this->event_id(), ctype_digit($query) ? (int) $query : 0, $like, $like, $like]
    );
    return array_map(fn($row) => $this->to_member($row), $rows);
  }

  // The lead member of a group is their own lead, and a member can lack one
  private function members_with_lead(): string {
    $table = $this->table();
    return "$table m LEFT JOIN $table lead_m ON lead_m.mid = m.lead_mid";
  }

  private function member_conditions(string $alias): string {
    return "$alias.is_paid = 1 AND $alias.is_approved = 1 AND $alias.is_deleted = 0 AND $alias.member_no > 0";
  }

  private function to_member(array $row): array {
    $name = trim((string) $row['badge_name']);
    if ($name === '') {
      $name = trim($row['first_name'] . ' ' . $row['last_name']);
    }
    return [
      'badge_no' => (int) $row['member_no'],
      'name' => $name,
      'email' => (string) $row['email'],
    ];
  }

  private function event_id(): int {
    return (int) config_get('conreg_db', 'event_id', 1);
  }

  // Drupal prefixes table names when the site is configured with a prefix
  private function table(): string {
    $prefix = (string) config_get('conreg_db', 'table_prefix');
    if (!preg_match('/^[A-Za-z0-9_]*$/', $prefix)) {
      throw new RuntimeException("[conreg_db] table_prefix may only contain letters, digits and underscores");
    }
    return "`{$prefix}conreg_members`";
  }

  private function query(string $sql, array $params): array {
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  private function pdo(): PDO {
    if ($this->pdo === null) {
      require_config('conreg_db', 'host', 'name', 'user');
      $port = config_get('conreg_db', 'port');
      $this->pdo = new PDO(
        'mysql:host=' . config_get('conreg_db', 'host') . ($port !== '' ? ';port=' . $port : '')
          . ';dbname=' . config_get('conreg_db', 'name') . ';charset=utf8mb4',
        config_get('conreg_db', 'user'),
        config_get_secret('conreg_db', 'password'),
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
        ]
      );
    }
    return $this->pdo;
  }
}
