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
  <p>We will post the mechanisms closer to the convention.

<?php
  // This is an example layout for the help page.
  /*
  <ul>
    <li><a href="#faq">FAQ</a></li>
    <li><a href="#reporting">Reporting potential Code of Conduct violations</a></li>
    <li><a href="#discord">Discord</a></li>
    <li><a href="#in-person">In person</a></li>
    <li><a href="#e-mail">E-mail</a></li>
    <li><a href="#telephone">Telephone</a></li>
  </ul>

  <h3><a name="faq">FAQ</a></h3>
  <p>We have assembled the answers to some frequently asked questions on the <a href="https://example.com/online-convention-faq/">FAQ</a> page.</p>

  <h3><a name="reporting">Reporting potential Code of Conduct violations</a></h3>
  <p>The <a href="https://www.smofconlisbon.org/policies/code-of-conduct">methods of reporting</a> page outlines the many routes available to report a potential Code of Conduct violation.</p>

  <h3><a name="discord">Discord</a></h3>
  <p>After <a href="/chat">joining our Discord server</a>, you can ask for help in the #help-desk channel.</p>
  <p>This can be a good option if you want to have a text conversation with someone.</p>
  <p><img src="/resources/help/discord.png?v=1" alt="A screenshot of Discord showing the #help-desk channel"></p>

  <h3><a name="in-person">In person</a></h3>
  <h4>Information desk</h4>
  <p>For general information and questions.</p>
  <p>Located in the main hall.</p>
  <p><a href="/times#information-desk">Open hours</a></p>

  <h4>Convention operations</h4>
  <p>General help and assistance, lost property and out-of-hours cover.</p>
  <p>Located next to the registration desk.</p>
  <p><a href="/times#con-ops">Open hours</a></p>

  <h4>Accessibility desk</h4>
  <p>For help with accommodating accessibility needs.</p>
  <p>Located in the main hall.</p>
  <p><a href="/times#accessibility-desk">Open hours</a></p>

  <h4>Listeners desk</h4>
  <p>Talk to someone privately about a sensitive topic, including potential Code of Conduct violations.</p>
  <p>Located in the main hall.</p>
  <p><a href="/times#listeners-desk">Open hours</a></p>

  <h4>Registration desk</h4>
  <p>For registration questions and problems.</p>
  <p>Located at the main entrance.</p>

  <h3><a name="e-mail">E-mail</a></h3>
  <p><a href="mailto:info@smofconlisbon.org">info@smofconlisbon.org</a> &mdash; General information, registration, accessibility, and help with this member portal</p>
  <p>To report a potential <a href="https://www.smofconlisbon.org/policies/code-of-conduct">Code of Conduct</a> violation, see the Code of Conduct page.</p>

  <h3><a name="telephone">Telephone</a></h3>
  <p>There is a telephone number on the back of your badge that you can call for help.</p>
  */
  ?>
</article>
<?php
render_footer();
?>