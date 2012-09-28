<?php
class form
{
	function __construct(){

	}

	public function TextField($name,$value='',$maxlength='120',$class='vTextField'){
		$input = sprintf('<input name="%s" value="%s" class="%s" maxlength="%d" type="text" id="id_%s">',
							$name,$value,$class,$maxlength,$name);
		return $input;
	}

} /*** end of class ***/
?>