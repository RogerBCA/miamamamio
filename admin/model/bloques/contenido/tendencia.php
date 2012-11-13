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
		$this->tabla = PREFIX.'tendencia';
		$this->grupo = PREFIX.'grupo';
		$this->multimedia = PREFIX.'multimedia';
		$this->db = new DB;
		$this->choice1 = $this->db->select(' id,nombre
											FROM '.$this->multimedia.' where exten=\'imagen\' order by nombre ');
		$this->choice2 = $this->db->select(' id,nombre
											FROM '.$this->grupo.' order by nombre ');
	}

	public function listar(){
		$this->datos = $this->db->select(' a.id as id, b.nombre as imagen, c.nombre as grupo
											FROM '.$this->tabla.' AS a
											LEFT OUTER JOIN '.$this->multimedia.' AS b 
											ON a.image_id = b.id 
											LEFT OUTER JOIN '.$this->grupo.' AS c 
											ON a.grupo_id = c.id ');
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
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') $errors['image'] = true;
		if ($app['grupo'] == '') $errors['grupo'] = true;

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			// Campos generales
			$query['active'] 		= $app['active'];
			$query['created'] 		= date('Y-m-d H:i:s');
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['created_by'] 	= $SESSION['iduser'];
			$query['modified_by'] 	= $SESSION['iduser'];

			$query['image_id']	= $app['image'];
			$query['grupo_id'] 	= $app['grupo'];

			$this->db->insert($this->tabla,$query);
			$this->devolverID = $this->db->devolverID;
			return true;
		}
	}

	public function actualizar($app,$id){
		$query = array();
		$errors = array();
		// recupedamos campos
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') $errors['image'] = true;
		if ($app['grupo'] == '') $errors['grupo'] = true;

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			// Campos generales
			$query['active'] 		= $app['active'];
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['modified_by'] 	= $SESSION['iduser'];

			$query['image_id']	= $app['image'];
			$query['grupo_id'] 	= $app['grupo'];

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