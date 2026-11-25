<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddDiseaseMitigationAndReportsPermissions extends AbstractMigration
{
    private const PERMISSIONS = [
        'see-disease-mitigation',
        'see-disease-mitigation-coming-soon',
        'see-reports',
        'see-reports-coming-soon',
    ];

    public function up(): void
    {
        $this->table('permissions')
            ->insert(array_map(fn($name) => ['name' => $name], self::PERMISSIONS))
            ->saveData();
    }

    public function down(): void
    {
        $names = implode(', ', array_map(fn($name) => "'" . $name . "'", self::PERMISSIONS));
        $this->execute("DELETE FROM role_permissions WHERE permission_id IN (SELECT permission_id FROM permissions WHERE name IN ($names))");
        $this->execute("DELETE FROM permissions WHERE name IN ($names)");
    }
}
