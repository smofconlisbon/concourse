<?php
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');

if (DISCORD_INVITE_URL === '') {
  render_404();
}

$badge_no = get_current_user_badge_no();
if ($badge_no === null) {
  header('Location: ' . make_login_link());
  exit;
}

db_record_discord_invite_click($badge_no);

header('Location: ' . DISCORD_INVITE_URL);
