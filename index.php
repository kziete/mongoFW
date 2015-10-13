<?php 
header("X-Powered-By: Mongo Framework");
require('config.php');

require(BASE_DIR . 'vendor/autoload.php');

$db = new DbHelper();

require(BASE_DIR . 'modelo.php');

/*Vistas*/
require(BASE_DIR . 'core/admin/admin.php');


/*Router*/
try{
	require(BASE_DIR . 'rutas.php');
}catch(Exception $e){
	echo $e->getMessage();
	/*$v = new ErrorVista();
	$v->excepcion($e);*/
}
