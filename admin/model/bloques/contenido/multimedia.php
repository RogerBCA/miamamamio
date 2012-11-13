<?php
class app{
	public $tabla;
	public $total;
	public $datos;
	public $errors;
	public $devolverID;

	function __construct(){
		$this->tabla = PREFIX.'multimedia';
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
        if( $_FILES['imagen']['name'] != '' ){
            $imagen = upload('multimedia',$_FILES['imagen'],'archivo','False');
            if($imagen != '') $errors['imagen'] = $imagen;
        }else {
            $errors['imagen'] = 'Este campo es obligatorio.';
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
			$query['imagen'] 	= upload('multimedia',$_FILES['imagen'],'archivo','True');
			$exten = explode('.', $query['imagen']);
			$query['exten']		= $this->extension($exten[1]);
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
        if( $_FILES['imagen']['name'] != '' ){
            $imagen = upload('multimedia',$_FILES['imagen'],'archivo','False');
            if($imagen != '') $errors['imagen'] = $imagen;
        }

		//a variables
		$this->datos = $app;
		$this->errors = $errors;

		if( $this->errors == false ){
			if(isset($app['active'])) $query['active'] = '1'; else $query['active'] = '0';

			// Campos generales
			$query['modified'] 		= date('Y-m-d H:i:s');
			$query['modified_by'] 	= $SESSION['iduser'];

			// Campos Adicionales
			$query['nombre'] 	= $app['nombre'];
			if( $_FILES['imagen']['name'] != '' ){
				$query['imagen'] 	= upload('multimedia',$_FILES['imagen'],'archivo','True');
			}else{
				$query['imagen']	= $app['imagen'];
			}
			$exten = explode('.', $query['imagen']);
			$query['exten']		= $this->extension($exten[1]);

			$this->db->update($this->tabla,$query,' id = '.$id);
			$this->devolverID = $this->db->devolverID;
			return true;
		}
		return false;
	}

	public function extension($var){
		if ( $var == 'pdf' or $var == 'doc' or $var == 'docx' ) {
			return 'documento';
		}elseif ( $var == 'jpg' or $var == 'png' or $var == 'bmp' or $var == 'gif' ) {
			return 'imagen';
		}else{
			return 'otros';
		}
	}

	public function eliminar($id){
		return $this->db->delete($this->tabla.' where id = '.$id);
	}

}
?>