<?php
function listar_bloque($ruta){
    if (is_dir($ruta)) { 
        if ($dh = opendir($ruta)) { 
            while (($file = readdir($dh)) !== false) { 
                if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
                    echo "<br>Directorio: $ruta$file";
                    listar_bloque($ruta . $file . "/");
                }elseif (strtolower(substr($file, -3) == "php")) {
                    echo "<br>Directorio: $ruta$file";
                }
            }
            closedir($dh); 
        }
    }
}

function url_validate($url){
    if (!preg_match("#^http(s)?://[a-z0-9-_.]+\.[a-z]{2,4}#i",$url)) {
        return 'false';
    }
    return 'true';
}

function upload($destination,$files,$image,$upload){
    $desti = $destination.'/';
    $destination = '../media/'.$destination.'/';
    $tmp_name = $files['tmp_name'];

    //si hemos enviado un directorio que existe realmente y hemos subido el archivo
    if ( is_dir($destination) && is_uploaded_file($tmp_name) ){
        // return 'existe';
        $img_file  = $files['name'];
        $img_type  = $files['type'];
        //¿es una imágen realmente?
        if($image == 'image'){
            $tipo_imagen = '';
            if($img_type == 'image/gif') $tipo_imagen = 'image/gif';
            if($img_type == 'image/jpeg') $tipo_imagen = 'image/jpeg';
            if($img_type == 'image/jpg') $tipo_imagen = 'image/jpg';
            if($img_type == 'image/png') $tipo_imagen = 'image/png';
            if($img_type != $tipo_imagen){
                return 'Envíe una imagen válida. El fichero que ha enviado
                no era una imagen o se trataba de una imagen corrupta.';
            }
        }
        //carateres especiales
        if(!preg_match("/[^0-9a-zA-Z_.-[:space:]]/",$img_file)) {
            //¿Tenemos permisos para subir la imágen?

            // Slug para archivo
            $img_file = explode('.', $img_file);
            $var = array_pop($img_file);
            $img_file = slug(implode('',$img_file));
            // fin de slug
            if($var != 'php'){
                $img_file .= '.'.$var;
                $file = $destination.$img_file;
                if(!file_exists($file)){
                    if($upload == 'True'){
                        if(move_uploaded_file($tmp_name, $file)){
                            return $desti.$img_file;
                        }else{
                            return 'Acceso denegado';
                        }
                    }else {
                        return '';
                    }
                }else {
                    return 'Nombre de archivo ya existe.';
                }
            }else{
                return 'Por seguridad no de acepta este tipo de archivos.';
            }
        }else{
            return 'Tiene carateres no permitidos.';
        }
    }
    //si llegamos hasta aquí es que algo ha fallado
    return 'Error al subir el archivo.';
}

function thumb($image){
$ext = explode("/", $image);
$ext = array_reverse($ext);
$thumb = "galeria/".$ext[0];
saveSquareThumb("media/".$image, $thumb, 150);
return $thumb;
}

function bannerIMG($seccion,$tipo = 'false'){
if ($tipo == 'query') {
$query = SeccionBanner($seccion,$tipo);
if($query != false) $query = $query[0]['image'];
}else {
$query = SeccionBanner($seccion);
if($query != false){
$query = $query[0]['image'];
}else {
$query = SeccionBanner($seccion,'True');
if($query != false) $query = $query[0]['image'];
}
}
return $query;
}

function printQuery($query){
    echo "<pre>"; print_r($query); echo "</pre>";
}

function ms_escape_string($data) {
    if ( !isset($data) or empty($data) ) return '';
    if ( is_numeric($data) ) return $data;

    $non_displayables = array(
    '/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
    '/%1[0-9a-f]/',             // url encoded 16-31
    '/[\x00-\x08]/',            // 00-08
    '/\x0b/',                   // 11
    '/\x0c/',                   // 12
    '/[\x0e-\x1f]/'             // 14-31
    );
    foreach ( $non_displayables as $regex )
    $data = preg_replace( $regex, '', $data );
    $data = str_replace("'", '"', $data );
    return $data;
}

function cleanQuery($string){
    $string = ms_escape_string($string);
    return xss_clean($string);
}

function valid_email($email) {
    $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
    if ( !preg_match($regexp, $email) ) return false; else return true;
}

function caracteres_latinos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}
 
function slug($cadena, $separador = '-'){
    //sin espacios al inicio o al final
    $cadena = trim($cadena);
 
    //limpiamos caracteres los latinos
    $cadena =  caracteres_latinos($cadena); 
 
    //pasamos a minúscula la cadena
    $cadena = strtolower($cadena); 
 
    //limpiamos
    $cadena = preg_replace('/[^a-z0-9-]/', $separador, $cadena);
    $cadena = preg_replace('/-+/', "-", $cadena);
    return $cadena;
}

function resumen($text) {
    $text = strip_tags(html_entity_decode($text));
    $text = trim($text);
    $text = substr($text, 0, 247);
    return $text."...";
}

function fecha($fecha){
    $phpdate = strtotime( $fecha );
    //Variable nombre del mes 
    $nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"); 

    //variable nombre día 
    $nomdia = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"); 

    /* date(j) toma valores de 1 al 31 segun el dia del mes 
    date(n) devuelve numero del 1 al 12 segun el mes 
    date(w) devuelve 0 a 6 del dia de la semana empezando el domingo 
    date(Y) devuelve el año en 4 digitos */ 

    $dia = date("j",$phpdate); //Dia del mes en numero 
    $mes = date("n",$phpdate); //Mes actual en numero 
    $diasemana = date("w",$phpdate); //Dia de semana en numero 

    $hoy = $nomdia[$diasemana].", ".$dia." de ".$nommes[$mes-1]." del ".date('Y',$phpdate).", ".date('h',$phpdate).":".date('i',$phpdate); 

    return $hoy;
}

function xss_clean($data){
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do{
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
}
?>