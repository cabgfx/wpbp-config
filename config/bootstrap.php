<?php
if (ereg("^(10|127|192)", $_SERVER['REMOTE_ADDR']) ) {
    require_once 'environments/development.php';
} else {
    require_once 'environments/production.php';
}

define('DB_NAME',     $WP_ENVIRONMENT['db_name']);
define('DB_USER',     $WP_ENVIRONMENT['db_user']);
define('DB_PASSWORD', $WP_ENVIRONMENT['db_password']);
define('DB_HOST',     $WP_ENVIRONMENT['db_host']);

define('WP_DEBUG',    $WP_ENVIRONMENT['wp_debug']);

define('WPBP_ENV',    $WP_ENVIRONMENT['name']);
?>