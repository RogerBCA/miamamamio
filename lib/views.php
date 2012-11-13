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
$locals['info'] = $info = $app->infosite();
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
            if( $v[3] != '' ){
                $locals['slide'] = $app->enlacestendencia_ver($grupo[0]->id,$v[3]);
                $locals['return'] = true;
            }else{
                $banner = $app->image_tendencia($grupo[0]->id);
                if($banner) $locals['slide'] = $banner;
                $locals['enlaces'] = $app->enlacestendencia($grupo[0]->id);
            }
            echo $twig->render('app/tendencia.html', $locals );
            // FIN DE TENDENCIAS

        }elseif ( $v[2]== 'coleccion' ) {

            // COLECCION
            if( $v[3] != '' ){
                $locals['slider'] = $app->enlacescoleccion_ver($grupo[0]->id,$v[3]);
                $locals['return'] = true;
            }else{
                $banner = $app->image_coleccion($grupo[0]->id);
                if($banner) $locals['slide'] = $banner;
                $locals['enlaces'] = $app->enlacescoleccion($grupo[0]->id);
            }

            echo $twig->render('app/coleccion.html', $locals );
            // FIN DE COLECCION

        }elseif ( $v[2]== 'regalos' ) {

            // PRODUCTOS REGALOS
            $productos = $app->productos('regalos',$grupo[0]->id);
            $locals['productos'] = $productos;
            echo $twig->render('app/regalos.html', $locals );
            //FIN DE PRODUCTOS REGALOS

        }elseif ( $v[2]== 'favoritos' ) {

            // PRODUCTOS FAVORITOS
            $productos = $app->productos('favoritos-del-mes',$grupo[0]->id);
            $locals['productos'] = $productos;
            echo $twig->render('app/favoritos.html', $locals );
            //FIN DE PRODUCTOS FAVORITOS

        }elseif ( $v[2]== 'promociones' ) {

            // PROMOCION
            $banner = $app->image_promocion($grupo[0]->id);
            if($banner) $locals['slide'] = $banner;
            $locals['promociones'] = $app->promociones($grupo[0]->id);
            if ( isset($v[3]) and $v[3] == 'list' ){
                echo $twig->render('app/promociones-list.html', $locals );
            }else{
                echo $twig->render('app/promociones.html', $locals );
            }
            // END PROMOCION

        }
    }elseif ( $v[1] == 'contacto' ) {

        // CONTACTO
        if( isset($POST['submit-contacto']) ){

            $locals['nombre']       = $POST['nombre'];
            $locals['email']        = $POST['email'];
            $locals['mensaje']      = $POST['mensaje'];
            foreach ($POST as $k => $v) if ($v == '') $locals['errors'][$k] = true;
            if( $locals['nombre'] == 'Nombre') $locals['errors']['nombre'] = true;
            if( $locals['email'] == 'E-Mail') $locals['errors']['email'] = true;
            if( $locals['mensaje'] == 'Mensaje') $locals['errors']['mensaje'] = true;

            if( !isset($locals['errors']) ){
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = "mix.minds@gmail.com";  
                $mail->Password = "pueblolibre";

                $body = $twig->render('app/email-contacto-estilizado.html', $locals );
                $mail->SetFrom("mix.minds@gmail.com","Contacto - ".app_name);
                $mail->AddAddress("rbaltazarc@gmail.com","Contacto - ".app_name);
                $mail->AddBCC("rbaltazarc@gmail.com","Administrador");
                if( valid_email($locals['email']) ){
                    $mail->AddBCC($locals['email'],"Cliente");
                }
                $mail->Subject    = "Contacto - ".app_name;
                $mail->AltBody    = "Para ver el mensaje, utilice un correo electrónico HTML compatible";
                $mail->MsgHTML($body);

                if(!$mail->Send()) {
                    $locals['errors']['proceso'] = "Error de Envio: " . $mail->ErrorInfo;
                }else{
                    $locals['exito']['pedido'] = true;
                }
            }
        }
        // printQuery($locals);
        echo $twig->render('app/contacto.html', $locals );
        // END CONTACTO

    }elseif ($v[1] == 'regalos-express' ) {

        // PRODUCTOS REGALOS
        $productos = $app->productos('regalos-express');
        $locals['productos'] = $productos;
        echo $twig->render('app/regalos_express.html', $locals );
        //FIN DE PRODUCTOS REGALOS

    }elseif ($v[1] == 'lista-baby-shower' ) {

        // INICIO DE LISTA DE BABY SHOWER
        $seccion = $app->query('seccion',array("nick='lista-baby-shower'",'active=1'));
        if ($seccion) {
            $seccion = $seccion[0];
            $locals['sec'] = $seccion;
            $locals['slide'] = $app->image_seccion($seccion->id);
            $bloques = $app->query('seccion',array("padre_id=".$seccion->id,'active=1'));
            $sec = $app->query('seccion',array("slug='".$v[2]."'",'active=1'));
            $locals['bloques'] = $bloques;
        }

        echo $twig->render('app/lista_baby_shower.html', $locals );
        // FIN DE LISTA

    }elseif ($v[1] == 'nosotros' ) {

        // BLOQUE NOSOTROS 
        $seccion = $app->query('seccion',array("nick='nosotros'",'active=1'));
        if ($seccion) {
            $seccion = $seccion[0];
            $locals['slide'] = $app->image_seccion($seccion->id);
            $bloques = $app->query('seccion',array("padre_id=".$seccion->id,'active=1'));
            if ( $v[2] == '' ) header('location: /nosotros/'.$bloques[0]->slug.'/');
            $sec = $app->query('seccion',array("slug='".$v[2]."'",'active=1'));
            if($sec){
                $locals['sec'] = $sec[0];
            }
            $locals['bloques'] = $bloques;
        }

        echo $twig->render('app/nosotros.html', $locals );
        // FIN DE BLOQUE

    }elseif ($v[1] == 'consejos' ) {

        // INICIO DE CONSEJOS 
        if( is_numeric($v[2]) ){
            $locals['new'] = $app->consejo_det($v[2]);
            echo $twig->render('app/consejos-ver.html', $locals );
        }else{
            $locals['consejos'] = $app->consejos('0','8');

            echo $twig->render('app/consejos.html', $locals );            
        }
        // FIN DE CONSEJOS 

    }elseif ($v[1] == 'noticias' ) {

        // INICIO DE LA NOTICIA 
        if( is_numeric($v[2]) ){
            $locals['new'] = $app->noticia_det($v[2]);
            echo $twig->render('app/noticias-ver.html', $locals );
        }else{
            $locals['noticias'] = $app->noticias('0','6');

            echo $twig->render('app/noticias.html', $locals );
        }
        // FIN DE LA NOTICIA

    }elseif ($v[1] == 'prensa' ) {

        // INICIO DE LA PRENSA
        $locals['prensa'] = $app->prensa('0','10');
        echo $twig->render('app/prensa.html', $locals );
        // FIN DE LA PRENSA

    }elseif ($v[1] == 'producto' ) {

        // INICIO DE PRODUCTO
        if( is_numeric($v[2]) ) $producto = $app->producto_det($v[2]);
        if( $producto ) $locals['prod'] = $producto;

        // PEDIDO
        if( isset($POST['submit-producto']) ){

            $locals['nombre']     = $POST['nombre'];
            $locals['horario']    = $POST['horario'];
            $locals['contactar']  = $POST['contactar'];
            $locals['telefono']   = $POST['telefono'];
            $locals['email']      = $POST['email'];
            $locals['cantidad']   = $POST['cantidad'];
            foreach ($POST as $k => $v) if ($v == '') $locals['errors'][$k] = true;
            if( !isset($locals['errors']) ){
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = "mix.minds@gmail.com";  
                $mail->Password = "pueblolibre";

                $body = $twig->render('app/email-pedido-estilizado.html', $locals );
                $mail->SetFrom("mix.minds@gmail.com","Pedido - ".app_name);
                $mail->AddAddress("rbaltazarc@gmail.com","Pedido - ".app_name);
                $mail->AddBCC("rbaltazarc@gmail.com","Administrador");
                if( valid_email($locals['email']) ){
                    $mail->AddBCC($locals['email'],"Cliente");
                }
                $mail->Subject    = "Pedido - ".app_name;
                $mail->AltBody    = "Para ver el mensaje, utilice un correo electrónico HTML compatible";
                $mail->MsgHTML($body);

                if(!$mail->Send()) {
                    $locals['errors']['proceso'] = "Error de Envio: " . $mail->ErrorInfo;
                }else{
                    $locals['exito']['pedido'] = true;
                }
            }
        }
        echo $twig->render('app/producto.html', $locals );
        // FIN DE PRODUCTO

    }else{

        echo $twig->render('app/grupo_det.html', $locals );

    }
}
?>
