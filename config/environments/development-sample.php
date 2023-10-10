<?php
$dev_server = preg_replace('/:.*/',"", $_SERVER['HTTP_HOST']);

define('WP_SITEURL', "https://$dev_server");
define('WP_HOME', "https://$dev_server");

define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

$WP_ENVIRONMENT = array(
	'db_name' => '',
	'db_user' => 'root',
	'db_password' => '',
	'db_host' => 'localhost',
	'wp_lang' => '',
	'wp_debug' => true,
	'name' => 'development'
);
?>
