<?php
/* LIMPIEZA DE GET Y POST */ 
if(isset($_POST)) $POST=array_map("cleanQuery",$_POST);
if(isset($_GET)) $GET=array_map("cleanQuery",$_GET);
if(isset($_SESSION)) $SESSION=array_map("cleanQuery",$_SESSION);
/* FIN DE LIMPIEZA GET Y POST  */

// Separando consultas internas
if(isset($_SERVER['PATH_INFO'])){
    $v = explode('/', $_SERVER['PATH_INFO']);
}else {
    $v[1] = 'home';
    $v[2] = '';
}

// Agregando clases para plantillas Django
Twig_Autoloader::register();
$loader     = new Twig_Loader_Filesystem(TEMPLATE);
$twig       = new Twig_Environment($loader, array('debug' => true));
$bl         = new bloques();

// Variable para envios a plantilla Twig
$locals = array();
$locals['app_name'] = app_name;

// Comprobando Usuario
$seguridad      = new seguridad();
$seguridad->verificar_session($SESSION);

if( isset($SESSION['iduser']) ){
    $locals['login'] = true;
    $locals['user'] = $seguridad->dat_sec;
    require_once 'controller/views.php';
}else{
    // Iniciar Session
    $locals['title'] = 'Iniciar sessión';
    if ( isset($POST['session-login']) ) {
        $seguridad->username = $POST['username'];
        $seguridad->password = $POST['password'];
        // Verificar login
        if( $seguridad->login() != true ){
            $locals['errors'] = $seguridad->errors;
        }
    }
    echo $twig->render('login.html', $locals );
}
?>