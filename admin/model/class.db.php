<?php
class DB{
	public $lastQuery;
    public $devolverID;
    private $db;
	function __construct(){
        $type       = tipo_db;
		$dbhost 	= servidor;
		$dbname		= dbase;
		$dbuser		= usuario;
		$dbpass		= clave;
		// database connection
		$this->rs = new PDO("$type:host=$dbhost;dbname=$dbname",$dbuser,$dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	public function query($sql){
		$this->rs->query($sql);
	}
	
	public function select($sql){
		$sql = 'SELECT '.$sql;
		$stmt = $this->rs->prepare($sql);
		$stmt->execute();
		$this->lastQuery = $sql;
		return $this->items = $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function delete($sql){
		$sql ='DELETE FROM '.$sql;
		return $this->rs->exec($sql);
	}
	
	public function getRow($sql){
		return array_shift($this->select($sql));
	}
	
	public function update($table,$items,$cond){
		$values = array();
		foreach($items as $k => $v){ 
			if($v == 'null'){
				array_push($values, "$k=null");
			}else{
				array_push($values, "$k='$v'");
			}
		}
		$sql = "UPDATE $table SET ".implode(',',$values)." WHERE $cond";
		$this->lastQuery = $sql;
        $update = $this->rs->exec($sql);
        $this->devolverID = $this->rs->lastInsertId('id');
		return $update;
	}
	
	public function insert($table,$items){
		$fields = array();
		$values = array();
		foreach($items as $k => $v){ 
			array_push($fields, "$k");
			if($v == 'null'){
				array_push($values, "null");
			}else{
				array_push($values, "'$v'");
			}
		}
		$sql = "INSERT 
			INTO 
				$table(".implode(',',$fields).") 
			VALUES
				(".implode(',',$values).")" ;
		#return $sql;
		$this->lastQuery = $sql;
        $insert = $this->rs->exec($sql);
        $this->devolverID = $this->rs->lastInsertId('id');
		return $insert;
	}
	
} /*** end of class ***/
?>