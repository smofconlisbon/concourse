<?php
$GLOBALS['app-data']['allow_implicit_anonymous'] = true;
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/session_auth.php');
require_once(getenv('CONFIG_LIB_DIR') . '/template.php');

render_header(
  'Opening times',
  'Opening times for ' . CON_NAME . '.',
  ['Home' => '/', 'Opening times']
);
?>
<article>
  <h2>Opening times</h2>
  <h3><a href="#registration-desk" name="registration-desk">Registration desk</a></h3>
  <ul class="times-list">
    <li>
      <p>Thursday, 3<sup>rd</sup> December</p>
      <p><a href="https://map.smofconlisbon.org/map/ground-floor/room/event-registration" target="_blank">Ground floor</a></p>
      <p>7pm&ndash;9pm</p>
    </li>
    <li>
      <p>Friday, 4<sup>th</sup> December</p>
      <p><a href="https://map.smofconlisbon.org/map/ground-floor/room/event-registration" target="_blank">Ground floor</a></p>
      <p>9am&ndash;5pm and 8pm&ndash;9pm</p>
    </li>
    <li>
      <p>Saturday, 5<sup>th</sup> December</p>
      <p><a href="https://map.smofconlisbon.org/map/first-floor/room/event-registration" target="_blank">First floor</a> (day membership and badge pickup)</p>
      <p>9am&ndash;noon</p>
    </li>
    <li>
      <p>Sunday, 6<sup>th</sup> December</p>
      <p><a href="https://map.smofconlisbon.org/map/first-floor/room/event-registration" target="_blank">First floor</a></p>
      <p>9am&ndash;noon (day membership)</p>
    </li>
  </ul>
</article>
<?php
render_footer();
?>