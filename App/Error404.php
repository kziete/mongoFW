<?php namespace App;

use Vista;

class Error404 extends Vista{
	function get(){
		$this->mostrar("404.html");
	}
}