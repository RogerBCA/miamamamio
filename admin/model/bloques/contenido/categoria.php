<?php
class app{
	public $tabla;
	public $total;
	public $datos;
	public $errors;
	public $devolverID;

	function __construct(){
		$this->tabla = PREFIX.'categoria';
		$this->db = new DB;
	}

	public function listar(){
		$this->datos = $this->db->select(' *
											FROM '.$this->tabla.'
											order by nombre');
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
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			if(isset($app['active'])) $query['active'] = '1'; else $query['active'] = '0';

			// Campos generales
			$query['created'] 		= date('Y-m-d H:i:s');
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['created_by'] 	= $SESSION['iduser'];
			$query['modified_by'] 	= $SESSION['iduser'];

			// Campos Adicionales
			$query['nombre'] 	= $app['nombre'];
			if ($app['slug'] == '') {
				$query['slug']	= slug($app['nombre']);
			}else{
				$query['slug'] 	= slug($app['slug']);
			}
			$query['position'] 	= $app['position'];

			$this->db->insert($this->tabla,$query);
			$this->devolverID = $this->db->devolverID;
			return true;
		}
		return false;
	}

	public function actualizar($app,$id){
		$query = array();
		$errors = array();
		// recupedamos campos
		if($app['nombre'] == '') $errors['nombre'] = true;
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			if(isset($app['active'])) $query['active'] = '1'; else $query['active'] = '0';

			// Campos generales
			$query['created'] 		= date('Y-m-d H:i:s');
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['created_by'] 	= $SESSION['iduser'];
			$query['modified_by'] 	= $SESSION['iduser'];

			// Campos Adicionales
			$query['nombre'] 	= $app['nombre'];
			if ($app['slug'] == '') {
				$query['slug']	= slug($app['nombre']);
			}else{
				$query['slug'] 	= slug($app['slug']);
			}
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