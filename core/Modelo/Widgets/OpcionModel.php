<?php namespace Modelo\Widgets;

use Modelo\Widgets\WidgetPadre;

class OpcionModel extends WidgetPadre{
	public $opciones;
	public function __construct($hash){
		parent::__construct($hash);
		$this->opciones = $hash['opciones'];
	}
	public function getInput($campo=null,$value=null){
		$opcionesMustache = array();

		foreach ($this->opciones as $k => $v) {
			$opcionesMustache[] = array(
				'value' => $k,
				'label' => $v,
				'checked' => ($k == $value)
			);
		}
		$hash = array(
			'name' => $campo,
			'opciones' => $opcionesMustache,
			'usarSelect' => (count($this->opciones) > 4) || $this->hash['usarSelect']
		);	
		return parent::input($hash);
	}

	public function getOutput($fila,$name){
		return $this->opciones[$fila[$name]];
	}
	
	public function getFilter($name,$search){
		$html .= '<select name="filtro[' . $name .']" onchange="this.form.submit()">' . "\n";
		$html .= '<option value="0"> -- Seleccionar -- </option>' . "\n";
		foreach ($this->opciones as $k => $v) {
			$html .= '<option value="' . $k . '" ' . ( ($search == $k) ? 'selected=""' : '' ) . '>' . $v . '</option>' . "\n";
		}
		$html .= '</select>' . "\n";
		return $html;
	}
	public function getCondition($name,$search){
		return $name . "='" . $search . "'";
	}
}