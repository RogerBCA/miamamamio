<?php
class app{
	public $tabla;
	public $total;
	public $datos;
	public $errors;
	public $devolverID;
	public $choice1;
	public $choice2;
	public $join;

	function __construct(){
		$this->join = 'grupo';
		$this->tabla = PREFIX.$this->join.'banner';
		$this->multimedia = PREFIX.'multimedia';
		$this->db = new DB;
		$this->choice1 = $this->db->select(' id,nombre
											FROM '.$this->multimedia.' order by nombre ');
		$this->choice2 = $this->db->select(' id,nombre
											FROM '.PREFIX.$this->join.' order by nombre ');
	}

	public function listar(){
		$this->datos = $this->db->select(' a.id as id, b.nombre as imagen, c.nombre as related
											FROM '.$this->tabla.' AS a
											LEFT OUTER JOIN '.$this->multimedia.' AS b 
											ON a.image_id = b.id 
											LEFT OUTER JOIN '.PREFIX.$this->join.' AS c 
											ON a.'.$this->join.'_id = c.id ');
		$this->total = count($this->datos);
		return $this->datos;
	}

	public function editar($k){
		return $this->datos[$k]['id'];
	}

	public function ver($id){
		$dato = $this->db->select(' * from '.$this->tabla.' where id = '.$id);
		if($dato){
			return $dato[0];
		}else{
			return $dato;
		}
	}

	public function insertar($app){
		$query = array();
		$errors = array();
		// recupedamos campos
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}
		if ($app['image'] == '') {
			$errors['image'] = true;
		}

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			// Campos Adicionales
			$query['enlace'] 	= $app['enlace'];
			$query['position'] 	= $app['position'];
			$query['image_id']	= $app['image'];
			if ($app[$this->join] == '') {
				$query[$this->join.'_id'] 	= 'null';
			}else{
				$query[$this->join.'_id'] 	= $app[$this->join];
			}

			$this->db->insert($this->tabla,$query);
			$this->devolverID = $this->db->devolverID;
			return true;
		}
	}

	public function actualizar($app,$id){
		$query = array();
		$errors = array();
		// recupedamos campos
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}
		if ($app['image'] == '') {
			$errors['image'] = true;
		}

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			$query['enlace'] 	= $app['enlace'];
			$query['position'] 	= $app['position'];
			$query['image_id']	= $app['image'];
			if ($app[$this->join] == '') {
				$query[$this->join.'_id'] 	= 'null';
			}else{
				$query[$this->join.'_id'] 	= $app[$this->join];
			}

			$this->db->update($this->tabla,$query,' id = '.$id);
			$this->devolverID = $this->db->devolverID;
			// echo $this->db->lastQuery;
			return true;
		}
		return false;
	}

	public function eliminar($id){
		return $this->db->delete($this->tabla.' where id = '.$id);
	}

}
?>