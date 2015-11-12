<?php namespace App;

use Modelo\Utils\Paginador;
use Tabla1;

class Test{
	function get(){
		$m = new Tabla1;
		$p = new Paginador($m,2,4);

		print_r($p->nav);
	}
}