<?php namespace App;

use Vista;

class Maquetas extends Vista{
	function get($tpl){
		$this->mostrar('maquetas/' . $tpl .".html");
	}
}