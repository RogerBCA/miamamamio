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

		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		//echo $this->db->lastQuery;
		return $consulta;
	}
	public function infosite(){
		$tabla = PREFIX.'infosite';
		$consulta = '* from '.$tabla;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function image_seccion($id){
		$a = PREFIX.'seccionbanner';
		$b = PREFIX.'multimedia';
		$consulta = 'a.enlace as enlace,b.imagen as imagen from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id where a.seccion_id='.$id.' order by a.position';
		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		return $consulta;
	}

	public function image_grupo($id){
		$a = PREFIX.'grupobanner';
		$b = PREFIX.'multimedia';
		$consulta = 'a.enlace as enlace,b.imagen as imagen from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id where a.grupo_id='.$id.' order by a.position';
		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		return $consulta;
	}

	public function image_promocion($id){
		$a = PREFIX.'promocionbanner';
		$b = PREFIX.'multimedia';
		$consulta = 'a.enlace as enlace,b.imagen as imagen from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id where a.grupo_id='.$id.' order by a.position';
		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		return $consulta;
	}

	public function image_tendencia($id){
		$a = PREFIX.'tendencia';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.grupo_id='.$id;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function image_coleccion($id){
		$a = PREFIX.'coleccion';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.video as video from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id where a.grupo_id='.$id;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
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

	public function promociones($id){
		$a = PREFIX.'promocion';
		$b = PREFIX.'multimedia';
		$consulta = 'a.id as id, a.nombre as nombre,b.imagen as imagen,
				a.descrip as descrip from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id where a.grupo_id='.$id.' order by a.position ';
		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		return $consulta;
	}

	public function productos($categoria,$grupo = 'NULL'){
		$a = PREFIX.'productos';
		$b = PREFIX.'categoria';
		$d = PREFIX.'multimedia';
		$consulta = 'a.id as id,a.nombre as nombre, a.codigo as codigo,
				a.precio as precio, d.imagen as imagen
				from '.$a.' as a inner join '.$b.' as b on
				a.categoria_id = b.id inner join '.$d.' as d on
				a.image_id = d.id 
				where b.slug=\''.$categoria.'\' ';
		if($grupo != 'NULL') $consulta .= 'and a.grupo_id='.$grupo;
		$consulta .= ' order by a.position ';
		$consulta = $this->db->select($consulta);
		return $consulta;
	}

	public function producto_det($id){
		$a = PREFIX.'productos';
		$b = PREFIX.'categoria';
		$c = PREFIX.'multimedia';
		$consulta = 'a.id as id, a.nombre as nombre, a.codigo as codigo,
				a.precio as precio, c.imagen as imagen, a.descrip as descrip,
				b.nombre as categoria
				from '.$a.' as a inner join '.$b.' as b on
				a.categoria_id = b.id inner join '.$c.' as c on
				a.image_id = c.id 
				where a.id='.$id;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function consejos($inicio,$cantidad){
		$a = PREFIX.'consejo';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.nombre as nombre, a.id as id
				from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id order by a.position LIMIT '.$inicio.','.$cantidad;
		$consulta = $this->db->select($consulta);
		return $consulta;
	}

	public function consejo_det($id){
		$a = PREFIX.'consejo';
		$b = PREFIX.'multimedia';
		$consulta = 'a.id as id, a.nombre as nombre,
				b.imagen as imagen, a.descrip as descrip
				from '.$a.' as a inner join '.$b.' as b on
				a.image_id = b.id where a.id='.$id;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function noticias($inicio,$cantidad){
		$a = PREFIX.'noticia';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.nombre as nombre,
				a.id as id, a.descrip as descrip
				from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id order by a.position LIMIT '.$inicio.','.$cantidad;
		$consulta = $this->db->select($consulta);
		return $consulta;
	}

	public function prensa($inicio,$cantidad){
		$a = PREFIX.'prensa';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, c.imagen as pdf, a.nombre as nombre, a.id as id
				from '.$a.' as a inner join '.$b.' as b on
				b.id = a.image_id inner join '.$b.' as c on
				c.id = a.pdf_id order by a.position LIMIT '.$inicio.','.$cantidad;
		$consulta = $this->db->select($consulta);
		// echo $this->db->lastQuery;
		return $consulta;
	}

	public function noticia_det($id){
		$a = PREFIX.'noticia';
		$b = PREFIX.'multimedia';
		$consulta = 'a.id as id, a.nombre as nombre,
				b.imagen as imagen, a.descrip as descrip
				from '.$a.' as a inner join '.$b.' as b on
				a.image_id = b.id where a.id='.$id;
		$consulta = $this->db->select($consulta);
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function enlacestendencia($id){
		$a = PREFIX.'tendenciaenlace';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.enlace as enlace, a.slug as slug
				from '.$b.' as b inner join '.$a.' as a on
				b.id = a.icono_id where a.grupo_id='.$id.' order by a.position LIMIT 0,3';
		$consulta = $this->db->select($consulta);
		return $consulta;
	}

	public function enlacestendencia_ver($id,$slug){
		$a = PREFIX.'tendenciaenlace';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.enlace as enlace, a.slug as slug
				from '.$b.' as b inner join '.$a.' as a on
				b.id = a.image_id where a.grupo_id='.$id.' and a.slug=\''.$slug.'\' order by a.position ';
		$consulta = $this->db->select($consulta);
		// echo $this->db->lastQuery;
		if($consulta) $consulta = $consulta[0];
		return $consulta;
	}

	public function enlacescoleccion($id){
		$a = PREFIX.'coleccionenlace';
		$b = PREFIX.'multimedia';
		$consulta = 'b.imagen as imagen, a.enlace as enlace, a.slug as slug
				from '.$b.' as b inner join '.$a.' as a on
				b.id = a.icono_id where a.grupo_id='.$id.' order by a.position LIMIT 0,2';
		$consulta = $this->db->select($consulta);
		return $consulta;
	}

	public function enlacescoleccion_ver($id,$slug){
		$a = PREFIX.'coleccionbanner';
		$b = PREFIX.'multimedia';
		$c = PREFIX.'coleccionenlace';
		$consulta = 'a.enlace as enlace, b.imagen as imagen from '.$a.' as a
				inner join '.$b.' as b on b.id = a.image_id
				inner join '.$c.' as c on c.id = a.coleccion_id
				where c.grupo_id='.$id.' and c.slug=\''.$slug.'\' order by a.position';
		$consulta = $this->db->select($consulta);
		$this->total = count($consulta);
		return $consulta;
	}

}
?>