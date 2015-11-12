<?php namespace Modelo\Utils;

/**
 * Clase helper para generar paginación a traves
 * de un query set de modelo
 *
 * @author Sebastián Díaz <kziete@gmail.com>
 */

class Paginador{
	private $queryset;
	private $porpagina;
	private $pagina;
	private $rango;

	private $totalPaginas;	
	private $filas;
	private $inicio;

	public $cont = array();
	public $nav = array();
	public $siguiente = false;
	public $anterior = false;

	/**
	* @param ModeloPadre 	$queryset 	QUERYSET de datos
	* @param int 			$porpagina 	cantidad de items por página
	* @param int 			$pagina 	página actual
	* @param int 			$rango 		rango de botones en paginación
	*/
	function __construct($queryset,$porpagina,$pagina = 1,$rango = 3){
		$this->queryset = $queryset;
		$this->porpagina = $porpagina;
		$this->pagina = $pagina;
		$this->rango = $rango;

		$this->init();
		
	}

	function init(){

		$this->filas = count($this->queryset);
		$this->totalPaginas = ceil($this->filas/$this->porpagina);

		$this->inicio = ($this->pagina-1) * $this->porpagina;	
		$this->setContenido();
		$this->setNav();
	}

	function setContenido(){
		$this->cont = $this->queryset->limit($this->inicio . "," . $this->porpagina)->rawData();
	}

	function setNav(){
		if($this->totalPaginas > 1){
			$tmp = array();
			for ($i=1; $i <= $this->totalPaginas; $i++) {

				if(abs($this->pagina - $i) > $this->rango)
					continue;

				$tmp[$i-1]['numero'] = $i;
				if($i == $this->pagina)				
					$tmp[$i-1]['actual'] = true;
			}
			$limpio = array();
			foreach ($tmp as $v) {
				$limpio[] = $v;
			}
			$this->nav = $limpio;
			
			if($this->pagina < $this->totalPaginas){
				$this->siguiente = $this->pagina + 1;
				$this->ultima = $this->totalPaginas;
			}

			if($this->pagina > 1)
				$this->anterior = $this->pagina - 1;
		}
	}
}