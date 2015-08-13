<?php namespace Modelo;

use Iterator;
use IteratorAggregate;
use ArrayAccess;
use Exception;

class ModeloPadre implements IteratorAggregate, ArrayAccess{
	protected $table;
	protected $db;

	protected $data = array();
	protected $filtros = array();
	protected $orden;


	public function __construct(){
		global $db;
		$this->db = $db;
		$this->table = get_class($this);
	}

	#IteratorAggregate
	public function getIterator(){
		if(empty($this->data))
			$this->makeQuery();

		return new MyIterator($this->data);
	}

	#ArrayAccess
	public function offsetGet($offset){
		if(empty($this->data))
			$this->makeQuery();
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->data[] = $value;
		} else {
			$this->data[$offset] = $value;
		}
	}
	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}
	public function offsetUnset($offset) {
		unset($this->data[$offset]);
	}




	public function makeQuery(){
		$sql = "select * from " . $this->table;

		$params = array();
		if(!empty($this->filtros)){
			$where = $this->getWhere($this->filtros);
			$sql .= $where['where'];
			$params = $where['params'];
		}
		#$sql .= ' where ' . join("=? and ",array_keys($this->filtros)) . "=?";			
		if($this->orden)
			$sql .= ' order by ' . $this->orden;


		$query = $this->db->sql($sql,$params);

		$this->data = $this->db->fetch($query);
	}

	public function getWhere($filtros){
		$wheres = array();
		$params = array();
		foreach ($filtros as $field => $value) {
			$field_parts = explode("__",$field);
			if($field_parts[1]){
				switch($field_parts[1]){
					case 'like':
						$wheres[] = $field_parts[0] . ' like ?';
						$params[] = '%' . $value . '%';
						break;

					case 'gt':
						$wheres[] = $field_parts[0] . ' > ?';
						$params[] = $value;
						break;

					case 'gte':
						$wheres[] = $field_parts[0] . ' >= ?';
						$params[] = $value;
						break;

					case 'lt':
						$wheres[] = $field_parts[0] . ' < ?';
						$params[] = $value;
						break;

					case 'lte':
						$wheres[] = $field_parts[0] . ' <= ?';
						$params[] = $value;
						break;
				}
			}else{
				$wheres[] = $field . '=?';
				$params[] = $value;
			}
		}
		return array(
			'where' => count($wheres) > 0 ? " where " . join(' and ', $wheres) : "",
			'params' => $params
		);
	}

	public function saveData($data,$recolectarErrores = false){
		
		//$mensajes = false;
		//if($this->validar($data,$recolectarErrores)){
		$this->validar($data,$recolectarErrores);
		
		if($data['id']){
			$this->db->update($this->table,$data,array('id' => $data['id']));
			return $data['id'];
		}else{
			$this->db->insert($this->table,$data);
			return $this->db->lastInsert();
		}
		/*}else
			$mensajes = "error de válidacion, implementar algo bonito o con mas info";			

		return $mensajes;*/
	}
	public function getRows(){
		$this->resetData();
		return $this;
	}
	public function filter($filtros=array()){
		$this->resetData();
		$this->filtros = $filtros;
		return $this;
	}

	public function orderBy($orden='id asc'){
		$this->resetData();
		$this->orden = $orden;
		return $this;
	}

	public function rawData(){
		if(empty($this->data))
			$this->makeQuery();
		return $this->data;
	}

	public function resetData(){
		$this->data = array();
	}


	public function getRowsPaged($pagina){
		$pagina = $pagina ? $pagina : 1;
		$porpagina = 20;
		$sql = "select * from " . $this->table;
		$filtros = $_GET['filtro'];
		if(!empty($filtros)){

			$lista = array();
			foreach (get_object_vars($this) as $k => $v) {
				if(in_array($k, array_keys($filtros)) && $filtros[$k])
					$lista[] = $v->getCondition($k,$filtros[$k]);
			}

			$where = join(' and ', $lista);
			if(!empty($lista))
				$sql .= ' where ' . $where;
		}
		return $this->db->sqlPaginado($sql,$pagina,$porpagina);
	}
	public function getBy($filtros){
		$sql = "select * from " . $this->table;
		$where = $this->getWhere($filtros);
		$sql .= $where['where'];

		$query = $this->db->sql($sql,$where['params']);
		$rows = $this->db->fetch($query);

		if(count($rows) <= 0)
			throw new Exception("Tupla no encontrada");
		if(count($rows) > 1)
			throw new Exception("La query devolvio mas de 1 una tupla");

		return $rows[0];
	}
	public function delete($index){
		$sql = "delete from " . $this->table . " where id=?";
		$query = $this->db->sql($sql,array($index));
	}
	public function validar($data,$recolectarErrores = false){
		$error = false;
		foreach (get_object_vars($this) as $k => $v) {

			if(/*array_key_exists($k,$data) &&*/ is_object($v) && method_exists($v, 'validar')){
				
				try{
					$v->validar($data[$k],$k);
				}catch(\Excepciones\ExcepcionCampo $e){
					$error = true;
					if($recolectarErrores){
						$v->error = $e->getMessage();
					}else{
						throw $e;
					}					
				}
			}
		}
		if($error)
			throw new \Excepciones\ExcepcionFormulario("Error de validaciones");
	}
	public function getReferencias($data){
		if(empty($data))
			return $data;
		$buscar = array();
		foreach (get_object_vars($this) as $k => $v) {
			if(is_object($v))
				//a futuro poner mas Tipos de modelos que necesiten la misma referenciacion
				if(in_array(get_class($v), array('ReferenciaModel'))){
					$buscar[$k] = array(
						'modelo' => $v->model->table,
						'label' => $v->label,
						'aBuscar' => array()
					);
				}
		}
		foreach ($data as $k => $v) {
			foreach ($buscar as $kk => $vv) {
				if(!in_array($v[$kk], $buscar[$kk]['aBuscar']) && $v[$kk])
					$buscar[$kk]['aBuscar'][] = $v[$kk];
			}
		}
		foreach ($buscar as $fk_name => $v) {
			$query = $this->db->sql("select id," . $v['label'] . " from " . $v['modelo'] . " where id in(" . join(',', $v['aBuscar']) . ")");
			$tmp = $this->db->fetch($query);
			foreach ($tmp as $kk => $vv) {
				$lista[$vv['id']] = $vv[$v['label']];
			}

			foreach ($data as $llave => $info) {
				$data[$llave][$fk_name.'_ref'] = $lista[$info[$fk_name]];
			}
			
		}
		return $data;
	}

	public function getCampos(){
		$lista = array();
		foreach($this as $k => $v)
			$lista[$k] = $v;

		//print_r($lista);
		return $lista;
	}
}


class MyIterator implements Iterator
{
    private $var = array();
    
    public function __construct($array)
    {
        //if (is_array($array)) {
            $this->var = $array;
        //}

    }

    public function rewind()
    {
        #echo "rewinding\n";
        reset($this->var);
    }

    public function current()
    {
        $var = current($this->var);
        #echo "current: $var\n";
        return $var;
    }

    public function key()
    {
        $var = key($this->var);
        #echo "key: $var\n";
        return $var;
    }

    public function next()
    {
        $var = next($this->var);
        #echo "next: $var\n";
        return $var;
    }

    public function valid()
    {
        $key = key($this->var);
        $var = ($key !== NULL && $key !== FALSE);
        #echo "valid: $var\n";
        return $var;
    }

}