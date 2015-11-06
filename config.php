<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
ini_set('display_errors',1);

define(BASE_DIR, __DIR__ . '/');

define(ADMIN_TEMPLATE_DIR , BASE_DIR . 'core/admin/templates/' );
define(ADMIN_TEMPLATE_CACHE_DIR , ADMIN_TEMPLATE_DIR . 'cache/' );

if(file_exists("config_prod.php"))
	include("config_prod.php");

define(HOST, 'localhost');
define(USER, 'root');
define(PASSWORD, '');
define(DATABASE, 'mongo');
define(DB_DRIVER, 'pdo_mysql');
define(DEBUG_MODE,true);


