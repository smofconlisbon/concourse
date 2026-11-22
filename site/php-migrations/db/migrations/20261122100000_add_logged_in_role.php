<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddLoggedInRole extends AbstractMigration
{
    public function up(): void
    {
        $this->table('roles')->insert([['name' => 'logged-in']])->saveData();
    }

    public function down(): void
    {
        $this->execute("DELETE FROM role_permissions WHERE role_id IN (SELECT role_id FROM roles WHERE name = 'logged-in')");
        $this->execute("DELETE FROM member_roles WHERE role_id IN (SELECT role_id FROM roles WHERE name = 'logged-in')");
        $this->execute("DELETE FROM roles WHERE name = 'logged-in'");
    }
}
