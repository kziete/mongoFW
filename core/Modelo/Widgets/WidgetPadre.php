<?php namespace Modelo\Widgets;

class WidgetPadre{
	protected $hash;
	protected $mustacho;
	protected $inputTemplate;
	protected $outputTemplate;
	protected $db;

	public function __construct($hash){
		$this->hash = $hash;
		
		$loader = new \Twig_Loader_Filesystem(BASE_DIR . 'core/Modelo/Widgets/templates/');
		$this->twig = new \Twig_Environment($loader, array(
			'cache' => ADMIN_TEMPLATE_CACHE_DIR,
			'debug' => DEBUG_MODE
		));

		$this->inputTemplate = 'inputs/' . get_class_name(get_class($this)) . '.html';
		$this->outputTemplate = 'outputs/' . get_class_name(get_class($this)) . '.html';
	}
	public function getNombre($columna){
		return $this->hash['nombre'] ? $this->hash['nombre'] : $columna;
	}
	public function input($hash){
		return $this->twig->render($this->inputTemplate, $hash);
	}	
	public function getOutput($fila,$name){
		return $fila[$name];
	}
	public function validar($value,$name){
		if($this->hash['notnull'] && $value ==''){
			#$this->error = "Este campo es obligatorio";
			throw new \Excepciones\ExcepcionCampo("$name es campo obligatorio");
		}
		/*if(method_exists($this, 'validarPropio'))
			if(!$this->validarPropio($value))
				return false;

		if(is_callable($this->hash['validar']))
			if($this->error = $this->hash['validar']($value,$name))
				return false;


		return true;*/
	}
	public function prepararDato($name,$value){
		return $value;
	}
	public function getIncludes(){
		return array();
	}
	public function getFilter($name,$search){
		return '<input type="text" name="filtro[' . $name . ']" value="' . $search . '">';
	}
	public function getCondition($name,$search){
		return $name . " like '%" . $search . "%'";
	}
	public function getFieldType(){
		return "varchar(256)";
	}
	public function getAlters($name){
		return false;
	}
}

function get_class_name($classname)
{
    if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
    return $pos;
}