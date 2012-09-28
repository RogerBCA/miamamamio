<?php
class bloques
{
	public $app_list = array();
	public $models;
	public $model;
	public $app = 0;

	function __construct(){
		$this->tabla = 'pb_content_type';
		$this->db = new DB;

		$app_list = $this->db->select('app_label as name from '.$this->tabla.' group by app_label;');
		if($app_list){
			foreach ($app_list as $k => $dir) {
				$this->app_list[$k]['name']		= $dir->name;
				// $this->app_list[$k]['app_url']	= ADMIN_SITE.strtolower($dir->name).'/';
				$this->app_list[$k]['models']	= $this->modulos($dir->name);
			}
		}
	}

	public function modulos($dir){
		$app = $this->db->select('* from '.$this->tabla.' where app_label=\''.$dir.'\' order by name;');
		if ($app) {
			$models = array();
			foreach ($app as $k => $model) {
				$models[$k]['name']			= ucwords($model->name_plural);
				$models[$k]['app_label']	= $model->app_label;
				$models[$k]['perms']		= $this->perms($model->id);
				$models[$k]['admin_url']	= ADMIN_SITE.strtolower($dir).'/'.$model->model.'/';
			}
		}else{
			$models = false;
		}
		return $models;
	}

	public function perms($id){
		// Conprueba seguridad con usuario actual
		$perms = array();
		$perms['change']	= true;
		$perms['add']		= true;
		return $perms;
	}

	public function actual($dir='',$app=''){
		if($dir != 'home'){
			if($app == ''){
				$this->models = $this->modulos($dir);
				if($this->models){
					$this->model['name'] = $this->models[0]['app_label'];
					$this->app = 1;
					return true;
				}else{
					return false;
				}
			}else{
				$query = $this->db->select('id, name, name_plural, app_label from '.$this->tabla.' where app_label=\''.$dir.'\' and model=\''.$app.'\';');
				if($query){
					$this->model = $query[0];
					$this->model->perms	= $this->perms($this->model->id);
					$this->model->app_url	= ADMIN_SITE.strtolower($dir).'/';
					$this->model->admin_url	= ADMIN_SITE.strtolower($dir).'/'.strtolower($app).'/';
					$this->app = 2;
					return true;
				}else{
					return false;
				}
			}
		}else{
			return true;
		}
	}

} /*** end of class ***/
?>