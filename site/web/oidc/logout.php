<?php
require_once(getenv('CONFIG_LIB_DIR') . '/config.php');
require_once(getenv('CONFIG_LIB_DIR') . '/db.php');
require_once(getenv('CONFIG_LIB_DIR') . '/auth/oidc_routes.php');

// Back-channel logout: the provider POSTs a signed logout token naming the
// provider session that ended. With a sid, only the portal sessions started
// from that provider session are deleted; with only a sub, every session of
// that user is.
$provider = oidc_provider_or_404();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  header('Allow: POST');
  exit('Method Not Allowed');
}

$claims = $provider->verified_logout_claims();
if ($claims === null) {
  auth_log('oidc-logout-invalid-token');
  http_response_code(400);
  exit('Bad Request: invalid logout token');
}

$deleted = 0;
if ($claims['sid'] !== null) {
  $deleted = db_delete_sessions_by_sid($claims['sid']);
} elseif ($claims['sub'] !== null) {
  $deleted = db_delete_sessions_by_sub($claims['sub']);
}
auth_log('oidc-logout', ['sid' => $claims['sid'], 'sub' => $claims['sub'], 'sessions_deleted' => $deleted]);
// Not cacheable, per the OIDC back-channel logout spec
header('Cache-Control: no-store');
echo 'OK';
