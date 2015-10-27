<?php namespace Modelo;

use duncan3dc\Phpexcel\Excel;


class AdminPadre{
	public $adminName;
	protected $mustacho;
	protected $model;
	protected $post = null;
	
	public function __construct(){		

		$loader = new \Twig_Loader_Filesystem(ADMIN_TEMPLATE_DIR);
		$this->twig = new \Twig_Environment($loader, array(
			'cache' => ADMIN_TEMPLATE_CACHE_DIR,
			'debug' => DEBUG_MODE
		));

		$this->adminName = get_class($this);
		$this->model = new $this->modelName;
		$this->nombre = $this->nombre ? $this->nombre : $this->modelName;
	}
	public function getForm($index,$error=false){
		if($index != -1){
			$data =  $this->model->getBy(array("id" => $index));
			if(!$data)
				echo 'Sacame de Aca';
		}
		if($this->post != null)
			$data = $this->prepararDatos($this->post);
		
		$camposHtml = array();
		$includes = array();
		
		foreach (get_object_vars($this->model) as $k => $v) {
			$tmp = $v->getIncludes();
			foreach ($tmp as $kk => $vv) {
				$includes[$kk] = $vv;
			}

			$camposHtml[] = array(
				'nombre' => $v->getNombre($k),
				'error' => $v->error ? $v->error : '',
				'input' => $v->getInput($k,$data[$k])
			);
		}

		$tmp = array();
		foreach ($includes as $k => $v) {
			$tmp[] = $v;
		}

		$output = array(
			'modelo' => $this->adminName,
			'campos' => $camposHtml,
			'includes' => $tmp,
			'error' => $error
		);
		return $this->twig->render('form.html',$output);
	}
	public function streamExcel(){
		if($_GET['filtro']){
			$filtros = array();
			foreach ($_GET['filtro'] as $key => $value) {
				if($value != '')
					$filtros[$key . '__like'] = $value;
			}
			//$filtros['fecha__gt'] = 1;
			$rows = $this->model->filter($filtros)->rawData();
		}else{
        	$rows = $this->model->rawData();
        }

        #print_r($rows);
        if(count($rows) > 0){
            $cabecera = array_keys($rows[0]);
            $excel = new Excel();

            foreach ($cabecera as $cont => $titulo) {                 
                $cell = $excel->getCellName($cont, 1);
                $excel->setCell($cell,$titulo, Excel::BOLD | Excel::CENTER);
            }

            foreach ($rows as $tcount => $tweet) {

                $col = 0;
                foreach ($tweet as $key => $value) {                    
                    $cell = $excel->getCellName($col, ($tcount +2));
                    $excel->setCell($cell,$value);
                    $col++;
                }
            }
        	$excel->output(strtolower($this->nombre) . '_' . Date("Y-m-d"));
        }
	}
	public function getGrid(){
		$paged = $this->model->getRowsPaged($_GET['p']);
		$data = $this->model->getReferencias($paged['cont']);

		$ordenado = array();
		foreach ($data as $k => $fila) {
			$ordenado[$k]['edit'] = '/admin/' . $this->adminName . '/' . $fila['id'];
			foreach ($this->mostrar as $campo) {
				$ordenado[$k]['outputs'][] = $this->model->{$campo}->getOutput($fila,$campo);
				$filtros[] = $this->model->{$campo}->getFilter($campo,$_GET['filtro'][$campo]);
			}
		}
		$filtros = array();
		$cabecera = array();
		foreach ($this->mostrar as $campo) {
			$filtros[] = $this->model->{$campo}->getFilter($campo,$_GET['filtro'][$campo]);
			$cabecera[] = $this->model->{$campo}->getNombre($campo);
		}
		$output = array(
			'modelo' => $this->adminName,
			'cabecera' => $cabecera,
			'filtros' => $filtros,
			'datos' => $ordenado,
			'nav' => $paged['nav'],
			'nav_flag' => count($paged['nav']),
			'url' => $paged['url'],
			'bloqueado' => $this->bloqueado
		);
		return $this->twig->render('grid.html',$output);
	}
	public function save($index){		
		if($_POST['aceptar']){
			unset($_POST['aceptar']);
			$this->post = $_POST;
			$grabar = $this->prepararDatos($_POST);
			
			if($index != -1)
				$grabar['id'] = $index;

			
			$this->model->saveData($grabar,true);
			$this->saveOk();
		}
	}
	public function saveOk(){
		header("Location: /admin/" . $this->adminName);
	}

	public function prepararDatos($post){
		$listo = array();
		foreach (get_object_vars($this->model) as $k => $modelo) {
			$listo[$k] = $modelo->prepararDato($k,$post[$k]);
		}
		return $listo;
	}
}

