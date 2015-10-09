<?php namespace App;

use Vista;

class Index extends Vista{
	function get(){
		$this->mostrar("home.html");
	}
}