<?php 
class Index extends Vista{
    function get() {


    	$hash = array(
    		'titulo' => 'Título'
    	);

        $db = new DbHelper;
        $t = new Tabla1;

        /*$id = $t->saveData(array(
            "campo1" => 1,
            "campo3" => 2
        ));

        echo $id;*/




        //$t = new Tabla1;

        /*$t->saveData(array(
            //'id' => 1,
            'campo1' => 'Hola---'
        ));*/

        //print_r($t->rawData());
    	

        $this->mostrar('home.html');
    }
}

class Probando extends Vista{
	function get(){
		$this->json(array(
			'titulo' => 'asd',
			'lista' => array(1,2,3)
		));
	}
}

class Error404{
	function get(){
		header("HTTP/1.0 404 Not Found");
		echo "404";
	}
}
