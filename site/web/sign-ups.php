<?php
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');
require_once(getenv('CONFIG_LIB_DIR') . '/signups.php');

render_header(
  'Sign-ups',
  'Sign-up for programme items at ' . CON_NAME . '.',
  ['Home' => '/', 'Sign-ups']
);
?>

<article>
  <h2>Sign-ups</h2>
  <p>To help our wonderful workshop hosts plan effectively, we ask that you sign up in advance for any workshop you'd like to attend.</p>
  <p>These sessions are designed to be interactive, so we're aiming for the right balance: enough people to create good discussion, but not so many that everyone doesn't get the chance to contribute.</p>
  <p>If you haven't signed up, you're still welcome to check whether there's space on the day. Many hosts will be happy to accommodate additional participants if capacity allows. However, signing up is the best way to guarantee your place and helps hosts make the most of the time they've volunteered to run the session.</p>
  <p>While some workshops have a hybrid option, none of them will be available for replay later.</p>
<?php
  $signup_url = 'https://docs.google.com/forms/d/e/1FAIpQLSdZkO7PMxbIyHt-zmK8Vuei9wJFD_7oWCcPd-BBHgtIdkH-Zw/viewform?usp=pp_url';
  if (is_logged_in()) {
    $signup_url .= '&entry.451737409=' . urlencode(get_current_user_name());
  }
?>
  <p><a class="button" href="<?php echo htmlspecialchars($signup_url); ?>" target="_blank">Sign up</a></p>
</article>
<?php
render_footer();
?>
