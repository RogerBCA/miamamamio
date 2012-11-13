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
		$this->tabla = PREFIX.'prensa';
		$this->multimedia = PREFIX.'multimedia';
		$this->db = new DB;
		$this->choice1 = $this->db->select(' id,nombre
											FROM '.$this->multimedia.' where exten=\'imagen\' order by nombre ');
		$this->choice2 = $this->db->select(' id,nombre
											FROM '.$this->multimedia.' where exten=\'documento\' order by nombre ');
	}

	public function listar(){
		$this->datos = $this->db->select(' * FROM '.$this->tabla.' order by position ');
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
		if($app['nombre'] == '') $errors['nombre'] = true;
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') $errors['image'] = true; else $app['image_id'] = $app['image'];
		if ($app['pdf'] == '') $errors['pdf'] = true; else $app['pdf_id'] = $app['pdf'];
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}

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

			// Campos Adicionales
			$query['nombre'] 	= $app['nombre'];
			$query['image_id']	= $app['image_id'];
			$query['pdf_id']	= $app['pdf_id'];
			$query['position'] 	= $app['position'];

			$this->db->insert($this->tabla,$query);
			$this->devolverID = $this->db->devolverID;
			return true;
		}
	}

	public function actualizar($app,$id){
		$query = array();
		$errors = array();
		// recupedamos campos
		if($app['nombre'] == '') $errors['nombre'] = true;
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') $errors['image'] = true; else $app['image_id'] = $app['image'];
		if ($app['pdf'] == '') $errors['pdf'] = true; else $app['pdf_id'] = $app['pdf'];
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			// Campos generales
			$query['active'] 		= $app['active'];
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['modified_by'] 	= $SESSION['iduser'];

			// Campos Adicionales
			$query['nombre'] 	= $app['nombre'];
			$query['image_id']	= $app['image'];
			$query['pdf_id']	= $app['pdf_id'];
			$query['position'] 	= $app['position'];

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