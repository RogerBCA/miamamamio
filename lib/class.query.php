<?php
class Query{
	public $tabla;
	public $total;
	public $datos;

	function __construct(){
		$this->db = new DB;
	}

	public function query($tabla,$where='',$columnas=''){
		$tabla = PREFIX.$tabla;
		if($columnas == '') $columnas = '*'; else $columnas = implode(',', $columnas);

		if($where == '') $where = ''; else $where = ' where '.implode(' and ', $where);

		$consulta = $columnas.' from '.$tabla.$where;

		$this->datos = $this->db->select($consulta);
		$this->total = count($this->datos);
		//echo $this->db->lastQuery;
		return $this->datos;
	}
	public function image_seccion($id){
		$a = PREFIX.'seccionbanner';
		$b = PREFIX.'multimedia';
		$consulta = 'a.enlace as enlace,b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.seccion_id='.$id;
		$this->datos = $this->db->select($consulta);
		$this->total = count($this->datos);
		return $this->datos;
	}
	public function image_grupo($id){
		$a = PREFIX.'grupobanner';
		$b = PREFIX.'multimedia';
		$consulta = 'a.enlace as enlace,b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.grupo_id='.$id;
		$this->datos = $this->db->select($consulta);
		$this->total = count($this->datos);
		//printQuery($this->datos);
		//echo $this->db->lastQuery;
		return $this->datos;
	}

	public function image_tendencia($id){
		$a = PREFIX.'tendencia';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.grupo_id='.$id;
		$this->datos = $this->db->select($consulta);
		if($this->datos) $this->datos = $this->datos[0];
		return $this->datos;
	}

	public function image_coleccion($id){
		$a = PREFIX.'coleccion';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.grupo_id='.$id;
		$this->datos = $this->db->select($consulta);
		if($this->datos) $this->datos = $this->datos[0];
		return $this->datos;
	}

	public function grupo_img_lateral($id){
		$a = PREFIX.'grupo';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.id='.$id;
		$consulta = $this->db->select($consulta);
		if ($consulta) $lateral = $consulta[0]->imagen; else $lateral = $consulta;
		return $lateral;
	}

	public function productos($categoria,$grupo = 'NULL'){
		$a = PREFIX.'productos';
		$b = PREFIX.'categoria';
		$c = PREFIX.'grupo';
		$d = PREFIX.'multimedia';
		$consulta = 'a.nombre as nombre, a.codigo as codigo,
				a.precio as precio, d.imagen as imagen
				from '.$a.' as a inner join '.$b.' as b on
				a.categoria_id = b.id ';
		if($grupo != 'NULL') $consulta .= 'inner join '.$c.' as c on a.grupo_id = c.id ';
		$consulta .= 'inner join '.$d.' as d on
				a.image_id = d.id 
				where b.slug=\''.$categoria.'\' ';
		if($grupo != 'NULL') $consulta .= 'and a.grupo_id='.$grupo;
		$consulta = $this->db->select($consulta);
		//echo $this->db->lastQuery;
		return $consulta;
	}

	public function producto_imagen($id){
		$a = PREFIX.'productos';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.id='.$id;
		$this->datos = $this->db->select($consulta);
		if($this->datos) $this->datos = $this->datos[0];
		return $this->datos;
	}

}
?>