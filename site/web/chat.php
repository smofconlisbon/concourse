<?php
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');

$use_invite_link = DISCORD_INVITE_URL !== '';
$use_oauth = !$use_invite_link && DISCORD_CLIENT_ID !== '';

// Must be set before session_auth.php runs. The invite link is for members only.
$GLOBALS['app-data']['allow_implicit_anonymous'] = $use_oauth;

require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');

$usernames = $use_oauth ? db_get_discord_usernames($_COOKIE[SESSION_COOKIE_NAME]) : [];

render_header(
  'Chat',
  'Join the Discord server for ' . CON_NAME,
  ['Home' => '/', 'Chat online']
);
?>

<article>
  <h2>Chat online</h2>
  <p>We are using a platform called <a href="https://discord.com/" target="_blank">Discord</a> to host our online chat, both text and audio/video. There are apps for desktop and mobile, or you can use it in your browser.</p>
<?php
  if ($use_invite_link) {
?>
  <p><a class="button" target="_blank" href="/join-discord">Join the Discord server</a></p>
<?php
  } else if (!$use_oauth) {
?>
  <p><strong>The Discord server isn't open yet. Please check back soon.</strong></p>
<?php
  } else if (empty($usernames)) {
    if (is_anonymous()) {
?>
  <p><a class="button" href="<?php echo make_login_link(); ?>">Log in to chat</a></p>
<?php
    } else {
?>
  <p><a class="button" target="_blank" href="<?php echo htmlspecialchars(discord_authorize_url()); ?>">Join the Discord server</a></p>
<?php
    }
  } else {
    if (count($usernames) === 1) {
?>
  <p>You have joined the Discord with the username <?php echo htmlspecialchars($usernames[0]); ?>.</p>
<?php
    } else {
?>
  <p>You have joined the Discord with the usernames:</p>
  <ul>
<?php
      foreach ($usernames as $username) {
?>
    <li><?php echo htmlspecialchars($username); ?></li>
<?php
      }
?>
  </ul>
<?php
    }
?>
  <p><a class="button" target="_blank" href="https://discord.com/channels/<?php echo DISCORD_GUILD_ID . '/' . DISCORD_INVITE_CHANNEL_ID ?>">Go to Discord in your browser</a> or log in as <?php echo htmlspecialchars($usernames[0]); ?> in the <a href="https://discord.com/download">Discord app</a></p>
  <p><a target="_blank" href="<?php echo htmlspecialchars(discord_authorize_url()); ?>">Join the Discord server as a different user</a></p>
<?php
  }
  if ($use_oauth) {
?>
  <p>Your server nickname will be automatically set to your convention badge name. This is only visible to people in this server, and not in any other servers you might be in. Your server nickname will be visible alongside your Discord username to other people in the server. You may change your nickname on this server if you wish, but we recommend keeping it to match your badge name to make it easier for people to find you.</p>

  <h3>Problems</h3>
  <p>Read the <a href="/discord-instructions" target="_blank">instructions on how to join the Discord server</a>.</p>
  <p>If you have any problems, email <a href="mailto:<?php echo SUPPORT_EMAIL; ?>"><?php echo SUPPORT_EMAIL; ?></a> from the e-mail you signed up with and include your discord username, if you know it.</p>
  <p>You can read through our <a href="https://www.google.co.uk">Guide to using Discord</a> for more information on how to use Discord.</p>
<?php
  }
?>
</article>

<?php
render_footer();
?>