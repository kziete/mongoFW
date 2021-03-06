<?php 
require(BASE_DIR . 'admin.php');

class VistaSistema extends Vista{
	public function __construct(){
		parent::__construct();

		$loader = new Twig_Loader_Filesystem(BASE_DIR . 'core/admin/templates');
		$this->twig = new Twig_Environment($loader, array(
			'cache' => BASE_DIR . 'core/admin/templates/cache',
			'debug' => DEBUG_MODE
		));
	}
}


class ErrorVista extends VistaSistema{
	public function __construct(){
		parent::__construct();
	}
	public function excepcion($e){
		$this->mostrar('excepcion.html',array(
			'mensaje' => $e->getMessage(),
			'file' => $e->getFile(),
			'line' => $e->getLine(),
			'trace' => $e->getTrace()
		));
	}
}

class AdminVista extends VistaSistema{
	public function __construct(){

		//print_r($_SERVER);
		session_start();
		//unset($_SESSION['login']);
		parent::__construct();

		$this->revisarPost();

		if($_GET['logout'])
			$this->logOut();

		if(!$_SESSION['login'])
			$this->pedirLogin();
	}

	public function pedirLogin($error = false){
		$this->mostrar('login.html',array('error' => $error));
		exit();
	}
	public function revisarPost(){
		if($_POST['login']){
			$db = new DbHelper();
			$user = $db->quote($_POST['user']);
			$pass = $db->quote($_POST['pass']);
			$query = $db->sql("select * from mongo_user where user=? and pass=?",array($user,$pass));
			$data = $db->fetch($query);

			if(!empty($data)){
				$_SESSION['login'] = $data[0];
				header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			}else{
				$this->pedirLogin("Usuario o Contraseña incorrecta :(");
			}
		}
	}
	public function logOut(){
		unset($_SESSION['login']);
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/admin');
		exit();
	}
}

class Admin extends AdminVista{
	public function __construct(){
		parent::__construct();
	}
	public function get(){
		global $registradas;

		$tmp = array();
		foreach ($registradas as $k => $v) {
			$obj = new $v;
			$hash = (array)$obj;
			if($obj->categoria)
				$tmp[$obj->categoria][] = $hash;
			else
				$tmp['Sin Categoría'][] = $hash;

		}
		$disp = array();
		foreach ($tmp as $k => $v) {
			$disp[] = array(
				'categoria' => $k,
				'lista' => $v
			);
		}

		$hash = array(
			'disponibles' => $disp
		);
		$this->mostrar('lista.html',$hash);
	}
}
class AdminLista extends AdminVista{
	public function __construct(){
		parent::__construct();
	}
	public function get($modelo){
		global $registradas;
		if(!in_array($modelo, $registradas))
			return;

		$a = new $modelo();
		if($_GET['excel'])
			return $a->streamExcel();
		
		$hash = array(
			'modelo' => $modelo,
			'content' => $a->getGrid(),
			'bloqueado' => $a->bloqueado,
			'nombre' => $a->nombre
		);
		$this->mostrar('cascara_grid.html', $hash);
	}
}

class AdminForm extends AdminVista{
	public function __construct(){
		parent::__construct();
	}
	public function get($modelo,$index){
		$a = new $modelo();
		if($_REQUEST['borrar']){
			$a->model->delete($index);
			header("Location: /admin/" . $modelo);
		}
		$hash = array(
			'modelo' => $modelo,			
			'content' => $a->getForm($index),
			'nombre' => $a->nombre
		);
		//$this->mostrar('contenedor.html',$hash);
		$this->mostrar('cascara_form.html', $hash);
	}

	public function post($modeloAdmin,$index){
		$a = new $modeloAdmin(); 
		try{
			$a->save($index);	
		}catch(\Excepciones\ExcepcionFormulario $e){
			$hash = array(
				'modelo' => $modeloAdmin,			
				'content' => $a->getForm($index,true),
				'mensaje' => $e->getMessage(),
				'nombre' => $a->nombre
			);
			$this->mostrar('cascara_form.html', $hash);
		}				
	}
}