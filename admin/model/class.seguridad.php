<?php
class seguridad
{
    // VARIABLES USADAS
	public $username;
	public $password;
	public $ud;
	public $iduser;
	public $dat_sec;
	public $SESSION;

	function __construct(){
		$this->tabla = 'pb_user';
		$this->db = new DB;
	}

	public function login(){
		$this->errors = array();
		// Comprobando campos vacios
		if ( $this->username == '' || $this->password == '' ) {
			$this->errors['mensaje'] = 'Por favor, corrija los siguientes errores.';
			if( $this->username == '' ) $this->errors['username'] = 'Este campo es obligatorio.';
			if( $this->password == '' ) $this->errors['password'] = 'Este campo es obligatorio.';
			return false;
		}else{
			$dat = $this->db->select(' * from '.$this->tabla.' where
						username = \''.$this->username.'\' and
						password = \''.md5($this->password).'\';');

			if ( $dat != false ) {
				$this->ud = $dat[0];
				$this->iduser = $this->ud->id;
				$this->actualizar_session();
				header( 'location: '.ADMIN_SITE );
				return;
			}else{
				$this->errors['mensaje'] = 'Por favor, introduzca un nombre de usuario y contraseña correctos.
								Note que ambos campos son sensibles a mayúsculas/minúsculas.';
				return false;
			}
		}
	}

	public function verificar_session($SESSION){
		$this->SESSION = $SESSION;
		if ( isset($this->SESSION['iduser']) && is_numeric($this->SESSION['iduser']) ) {
			$this->iduser = $this->SESSION['iduser'];
			$dat = $this->db->select(' * from '.$this->tabla.' where id = \''.$this->iduser.'\';');
			if ( $dat != false ) {
				$this->ud = $dat[0];
				$this->dat_sec['nick'] = $this->ud->username;
				$this->dat_sec['is_authenticated'] = true;
				if( $this->ud->is_staff == 1 and $this->ud->is_active == 1 ){
					$this->dat_sec['is_staff'] = true;
				}
			}
		}
	}

	public function actualizar_session(){
		$_SESSION['iduser'] = $this->iduser;
	}

} /*** end of class ***/
?>