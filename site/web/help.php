<?php
$GLOBALS['app-data']['allow_implicit_anonymous'] = true;
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');

render_header(
  'Help',
  'How to get help at ' . CON_NAME . '.',
  ['Home' => '/', 'Help']
);
?>
<article class="instructions">
  <h2>Help</h2>
  <p>There are many ways to get help, using whatever route is most convenient for you.</p>

  <h3>Online</h3>
  <h4><a name="discord">Discord</a></h4>
  <p>After <a href="/chat">joining our Discord server</a>, you can ask for help in the #meatspace-help or #cyberspace-help channels.</p>
  <p>This can be a good option if you want to have a text conversation with someone.</p>

  <h4><a name="e-mail">E-mail</a></h4>
  <p><a href="mailto:info@smofconlisbon.org">info@smofconlisbon.org</a> &mdash; General information, registration, accessibility, and help with this member portal</p>
  <p>To report a potential <a href="https://www.smofconlisbon.org/policies/code-of-conduct">Code of Conduct</a> violation, see the Code of Conduct page.</p>

  <h3>In person</h3>
  <h4><a name="registration-desk">Registration desk</a></h4>
  <p>For registration questions and problems.</p>
  <p>Located on the <a href="https://map.smofconlisbon.org/map/ground-floor/room/event-registration" target="_blank">ground floor</a> on Thursday and Friday, and on the <a href="https://map.smofconlisbon.org/map/first-floor/room/event-registration" target="_blank">first floor</a> on Saturday and Sunday.</p>

  <h4><a name="listeners">Listener</a></h4>
  <p>Talk to someone privately about a sensitive topic, including potential Code of Conduct violations.</p>
  <p>In person, you can ask at the registration desk to speak to a listener.</p>
  <p>Online or in-person, you can email <a href="mailto:coc@smofconlisbon.org">coc@smofconlisbon.org</a>.</p>
</article>
<?php
render_footer();
?>