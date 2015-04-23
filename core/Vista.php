<?php 

class Vista{
	protected $m;
	public function __construct(){

		// Create a Dwoo core object
		$this->dwoo = new \Dwoo\Core();

		// Configure directories
		$this->dwoo->setCompileDir(BASE_DIR . 'templates/cache'); // Folder to store compiled templates
		$this->dwoo->setTemplateDir(BASE_DIR . 'templates'); // Folder containing .
		
	}

	public function mostrar($template,$hash = array()){
		$this->dwoo->output($template, $hash);		
	}
	/*public function mostrarSinRender($template){
		echo file_get_contents($this->m->templateDir .$template, FILE_USE_INCLUDE_PATH);
	}

	public function getModulo($template,$hash = array()){		
		return $this->m->render($template,$hash);		
	}*/
	public function json($data){
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
