<?php
$GLOBALS['app-data']['allow_implicit_anonymous'] = 'always';
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');

render_header(
  'Privacy policy',
  'An explanation of the cookies we set and what they are used for',
  ['Home' => '/', 'Privacy policy']
);
?>
<article>
  <h2>Privacy policy</h2>
  <p>
    This policy explains what personal information the SMOFcon 43 member
    portal collects, why, and how it is handled. It is a general statement
    and may be updated before the convention.
  </p>

  <h3>Information we hold</h3>
  <ul>
    <li>Membership details provided when you registered, such as your name, badge name, email address and membership type.</li>
    <li>Your Discord user ID, if you choose to link your Discord account.</li>
    <li>Your programme selections, sign-ups and any other preferences you save on the portal.</li>
    <li>If you set a password, a salted hash of it. We never store the password itself.</li>
    <li>Basic technical logs, such as IP address and pages requested, kept for security and troubleshooting.</li>
  </ul>

  <h3>How we use it</h3>
  <ul>
    <li>To confirm you are a member and show you the content you are entitled to see.</li>
    <li>To run the convention, including the programme, sign-ups and Discord server access.</li>
    <li>To contact you about the convention.</li>
    <li>To keep the portal secure and working.</li>
  </ul>

  <h3>Cookies</h3>
  <p>
    The portal uses only the cookies it needs to work: a session cookie that
    keeps you logged in, and a security cookie that protects forms from
    cross-site request forgery. These are not used for advertising or
    tracking across other sites. You can delete them in your browser at any
    time, but you will then need to log in again.
  </p>

  <h3>Sharing</h3>
  <p>
    We do not sell your information. It is shared only with the convention
    volunteers who need it to run the event, and with service providers that
    host the portal or provide services you use through it, such as Discord.
    Those services have their own privacy policies.
  </p>

  <h3>Retention</h3>
  <p>
    We keep your information for as long as needed to run the convention and
    deal with any follow-up afterwards, then delete or anonymise it.
  </p>

  <h3>Your rights</h3>
  <p>
    You can ask to see, correct or delete the information we hold about you,
    or object to how we use it. Contact the convention team using the
    details on the <a href="/help">Help</a> page.
  </p>
</article>
<?php
render_footer();
?>