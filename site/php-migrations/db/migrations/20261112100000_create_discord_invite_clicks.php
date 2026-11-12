<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

// Records that a member followed the Discord invite link, as a stand-in for
// having joined when Discord accounts aren't linked with OAuth
final class CreateDiscordInviteClicks extends AbstractMigration
{
    public function change(): void
    {
        $this->table('discord_invite_clicks', ['id' => false, 'primary_key' => ['badge_no']])
            ->addColumn('badge_no', 'string', ['limit' => 10, 'null' => false])
            ->addColumn('clicked_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('badge_no', 'members', 'badge_no', ['delete' => 'CASCADE'])
            ->create();
    }
}
