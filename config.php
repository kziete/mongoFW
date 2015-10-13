<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
ini_set('display_errors',1);

define(BASE_DIR, __DIR__ . '/');
define(HOST, 'localhost');
define(USER, 'mongo');
define(PASSWORD, 'mongo');
define(DATABASE, 'mongo');
define(DB_DRIVER, 'pdo_mysql');
define(DEBUG_MODE,true);