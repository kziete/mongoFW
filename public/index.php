<?php 
header("X-Powered-By: Mongo Framework");
require('../config.php');

require(BASE_DIR . 'vendor/autoload.php');

$db = new DbHelper();

require(BASE_DIR . 'core/modelo/modeloWrapper.php');

/*Vistas*/
require(BASE_DIR . 'core/admin/admin.php');
require(BASE_DIR . 'vistas.php');


/*Router*/
require(BASE_DIR . 'rutas.php');
