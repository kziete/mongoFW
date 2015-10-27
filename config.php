<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
ini_set('display_errors',1);

define(BASE_DIR, __DIR__ . '/');



define(ADMIN_TEMPLATE_DIR , BASE_DIR . 'core/admin/templates/' );
define(ADMIN_TEMPLATE_CACHE_DIR , ADMIN_TEMPLATE_DIR . 'cache/' );





define(HOST, 'localhost');
define(USER, 'root');
define(PASSWORD, '');
define(DATABASE, 'mongo');
define(DB_DRIVER, 'pdo_mysql');
define(DEBUG_MODE,true);


