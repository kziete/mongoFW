<?php  namespace Modelo\Widgets;

use Modelo\Widgets\WidgetPadre;

class FechaHoraModel extends WidgetPadre{
	public $max_length;
	public function __construct($hash){
		parent::__construct($hash);
	}
	public function getInput($campo=null,$value=null){
		$hash = array(
			'placeholder' => $campo,
			'name' => $campo,
			'value' => $value
		);	
		return parent::input($hash);
	}
	public function getFieldType(){
		return 'datetime';
	}
	public function getIncludes(){

		return array(
			'datepicker.css' => '<link rel="stylesheet" type="text/css" href="/admin_assets/js/datepicker/jquery.datetimepicker.css"/ >',
			'datepicker.js' => '<script src="/admin_assets/js/datepicker/jquery.datetimepicker.js"></script>'
		);
	}
}