<?php 

class Vista{
	protected $m;
	public function __construct(){

		$loader = new Twig_Loader_Filesystem(BASE_DIR . 'templates');
		$this->twig = new Twig_Environment($loader, array(
			'cache' => BASE_DIR . 'templates/cache',
			'debug' => DEBUG_MODE
		));
		
	}
	public function mostrar($template,$hash = array()){		
		echo $this->twig->render($template,$hash);
	}
	public function json($data){
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
