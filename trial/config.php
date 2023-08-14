<?php
// Database configuration
define('DB_HOST' ,'localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME', 'planclock');

// Google API configuration
define('GOOGLE_CLIENT_ID', '386262907582-064llv0ofjlgga8j9jqmobeof8h4ciii.apps.googleusercontent.com' );
define( 'GOOGLE_CLIENT_SECRET','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');
define( 'GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');
define( 'REDIRECT_URI','http://localhost/clock/trial/google_calendar_event_sync.php');

// Google OAuth URI.
$googleOauthURL= 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode(GOOGLE_OAUTH_SCOPE).'&redirect_uri='.REDIRECT_URI.'&response_type=code&client_id='.GOOGLE_CLIENT_ID.
'&access_type=online';

if(!session_id()) session_start();




?>