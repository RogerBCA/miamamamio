<?php
class bloques
{
	public $app_list = array();
	public $models;

	public $dir;
	public $url;

    // VARIABLES USADAS
    public $url_dir;
    public $url_app;
    public $direct;

	function __construct(){
		$this->rb = CONTROLLER;

		$rs = dir($this->rb);
		$app_list = array();
		while ($db = $rs->read() ) {
			if( is_dir($this->rb.$db) && $db != '.' && $db != '..' ) $app_list[] = $db;
		}
		if($app_list){
			foreach ($app_list as $k => $dir) {
				$this->app_list[$k]['name']		= ucwords($dir);
				$this->app_list[$k]['app_url']	= ADMIN_SITE.$dir.'/';
				$this->app_list[$k]['models']	= $this->modulos($dir);
			}
		}

		$rs->close();
	}

	public function modulos($dir){
		if (is_dir($this->rb.$dir)) {
			$app = array();
			if ($dh = opendir($this->rb.$dir)) {
				while (($file = readdir($dh)) !== false) {
					if (strtolower(substr($file, -3) == "php")) {
						$app[] = str_replace('.php', '', $file);
					}
				}
				closedir($dh);
			}
		}
		if ($app) {
			$modulos = array();
			foreach ($app as $k => $model) {
				$modulos[$k]['name']		= ucwords($model);
				$modulos[$k]['listar']		= ADMIN_SITE.$dir.'/'.$model.'/';
				$modulos[$k]['add']		= ADMIN_SITE.$dir.'/'.$model.'/add/';
			}
		}
		return $modulos;
	}

	public function actual($dir,$app=''){
		if (is_dir($this->rb.$dir)) {
			$this->direct = ucwords($dir);
			$this->url_dir = ADMIN_SITE.$dir.'/';
		}
		if($app != ''){
			$this->model = ucwords($app);
			$this->url_app = ADMIN_SITE.$dir.'/'.$app.'/';
		}else {
			$this->model = '';
			$this->url_app = '';
		}
		return;
	}

} /*** end of class ***/
?>