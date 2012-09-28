<?php
/* LIMPIEZA DE GET Y POST */ 
if(isset($_POST)) $POST=array_map("cleanQuery",$_POST);
if(isset($_GET)) $GET=array_map("cleanQuery",$_GET);
if(isset($_SESSION)) $SESSION=array_map("cleanQuery",$_SESSION);
/* FIN DE LIMPIEZA GET Y POST  */

// Separando consultas internas
if(isset($_SERVER['PATH_INFO'])){
    if( $_SERVER['PATH_INFO'] == '/' ){
        $v[1] = 'home';
    }else{
        $v = explode('/', $_SERVER['PATH_INFO']);
    }
}else {
    $v[1] = 'home';
}

// Agregando clases para plantillas Django
Twig_Autoloader::register();
$loader     = new Twig_Loader_Filesystem(TEMPLATE);
$twig       = new Twig_Environment($loader, array('debug' => true));
$app         = new Query();

// Variable para envios a plantilla Twig
$locals = array();
$locals['app_name'] = app_name;
$locals['STATIC_URL'] = STATIC_URL;
$locals['SITE_URL'] = SITE_URL;

//printQuery($_SERVER);

if ($v[1] == 'home') {

    // PAGINA INICIAL
    $seccion = $app->query('seccion',array("slug='home'",'active=1'));
    if ($seccion) {
        $banner = $app->image_seccion($seccion[0]->id);
        if($banner) $locals['slide'] = $banner;
    }
    // printQuery($locals);
    echo $twig->render('app/home.html', $locals );
    // FIN DE PAGINA INICIAL

}else{
    $grupo = $app->query('grupo',array("slug='".$v[1]."'",'active=1'));
    if ($grupo) {
        $locals['grupo'] = $grupo[0];
        $locals['slug1'] = $v[2];
        if( $v[2] == '' ){
            $banner = $app->image_grupo($grupo[0]->id);
            if($banner) $locals['slide'] = $banner;
            $lateral = $app->grupo_img_lateral($grupo[0]->id);
            if($lateral) $locals['grupo']->imagen= $lateral;
            echo $twig->render('app/grupo_det.html', $locals );

        }elseif ( $v[2]== 'tendencia' ) {

            // TENDENCIAS
            $banner = $app->image_tendencia($grupo[0]->id);
            if($banner) $locals['slide'] = $banner;
            echo $twig->render('app/tendencia.html', $locals );
            // FIN DE TENDENCIAS

        }elseif ( $v[2]== 'coleccion' ) {

            // COLECCION
            $banner = $app->image_coleccion($grupo[0]->id);
            if($banner) $locals['slide'] = $banner;
            echo $twig->render('app/coleccion.html', $locals );
            // FIN DE COLECCION

        }elseif ( $v[2]== 'regalos' ) {

            // PRODUCTOS REGALOS
            $productos = $app->productos('regalos',$grupo[0]->id);
            $locals['productos'] = $productos;
            $grupo = $app->query('productos',array("grupo_id='".$grupo[0]->id."'",'active=1'));
            echo $twig->render('app/regalos.html', $locals );
            //FIN DE PRODUCTOS REGALOS

        }elseif ( $v[2]== 'favoritos' ) {

            // PRODUCTOS FAVORITOS
            $productos = $app->productos('favoritos',$grupo[0]->id);
            $locals['productos'] = $productos;
            $grupo = $app->query('productos',array("grupo_id='".$grupo[0]->id."'",'active=1'));
            echo $twig->render('app/favoritos.html', $locals );
            //FIN DE PRODUCTOS FAVORITOS

        }elseif ( $v[2]== 'promociones' ) {

            echo $twig->render('app/promociones.html', $locals );

        }
    }elseif ( $v[1] == 'contacto' ) {
        echo $twig->render('app/contacto.html', $locals );
    }elseif ($v[1] == 'regalos-express' ) {

        // PRODUCTOS REGALOS
        $productos = $app->productos('regalos-express');
        $locals['productos'] = $productos;
        $grupo = $app->query('productos',array("grupo_id='".$grupo[0]->id."'",'active=1'));
        echo $twig->render('app/regalos_express.html', $locals );
        //FIN DE PRODUCTOS REGALOS

    }elseif ($v[1] == 'lista-baby-shower' ) {
        echo $twig->render('app/lista_baby_shower.html', $locals );
    }elseif ($v[1] == 'nosotros' ) {
        echo $twig->render('app/nosotros.html', $locals );
    }elseif ($v[1] == 'consejos' ) {
        echo $twig->render('app/consejos.html', $locals );
    }elseif ($v[1] == 'noticias' ) {
        echo $twig->render('app/noticias.html', $locals );
    }elseif ($v[1] == 'prensa' ) {
        echo $twig->render('app/prensa.html', $locals );
    }else{
        echo $twig->render('app/grupo_det.html', $locals );
    }
}
?>
