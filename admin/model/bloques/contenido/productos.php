<?php
class app{
	public $tabla;
	public $total;
	public $datos;
	public $errors;
	public $devolverID;
	public $choice1;
	public $choice2;

	function __construct(){
		$this->tabla = PREFIX.'productos';
		$this->categoria = PREFIX.'categoria';
		$this->multimedia = PREFIX.'multimedia';
		$this->grupo = PREFIX.'grupo';
		$this->db = new DB;
		$this->choice1 = $this->db->select(' id,nombre
											FROM '.$this->categoria.' order by position ');
		$this->choice2 = $this->db->select(' id,nombre
											FROM '.$this->grupo.' order by position ');
		$this->choice3 = $this->db->select(' id,nombre
											FROM '.$this->multimedia.' where exten=\'imagen\' order by nombre ');

	}

	public function listar(){
		$this->datos = $this->db->select(' a.id as id, a.nombre as nombre , a.codigo as codigo,
											b.nombre as categoria, c.nombre as grupo
											FROM '.$this->tabla.' AS a
											LEFT OUTER JOIN '.$this->categoria.' AS b 
											ON a.categoria_id = b.id
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
		if($app['nombre'] == '') $errors['nombre'] = true;
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') {
			$errors['image'] = true;
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
			$query['codigo']	= $app['codigo'];
			$query['precio'] 	= $app['precio'];
			$query['descrip'] 	= $app['descrip'];
			$query['position'] 	= $app['position'];
			$query['image_id']	= $app['image'];
			if ($app['categoria'] == '') {
				$query['categoria_id'] 	= 'null';
			}else{
				$query['categoria_id'] 	= $app['categoria'];
			}
			if ($app['grupo'] == '') {
				$query['grupo_id'] 	= 'null';
			}else{
				$query['grupo_id'] 	= $app['grupo'];
			}
			if ($app['slug'] == '') {
				$query['slug']	= slug($app['nombre']);
			}else{
				$query['slug'] 	= slug($app['slug']);
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
		if($app['nombre'] == '') $errors['nombre'] = true;
		if( !is_numeric($app['position']) ){
			$errors['position'] = true;
			$app['position']	= '1';
		}
		if( isset($app['active']) ){
			$app['active'] = 1;
		}else{
			$app['active'] = 0;
		}
		if ($app['image'] == '') {
			$errors['image'] = true;
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
			$query['codigo']	= $app['codigo'];
			$query['precio'] 	= $app['precio'];
			$query['descrip'] 	= $app['descrip'];
			$query['position'] 	= $app['position'];
			$query['image_id']	= $app['image'];
			if ($app['categoria'] == '') {
				$query['categoria_id'] 	= 'null';
			}else{
				$query['categoria_id'] 	= $app['categoria'];
			}
			if ($app['grupo'] == '') {
				$query['grupo_id'] 	= 'null';
			}else{
				$query['grupo_id'] 	= $app['grupo'];
			}
			if ($app['slug'] == '') {
				$query['slug']	= slug($app['nombre']);
			}else{
				$query['slug'] 	= slug($app['slug']);
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