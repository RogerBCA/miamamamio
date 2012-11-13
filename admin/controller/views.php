<?php
//Guiando a la app actual

if( isset($_GET['app']) and $_GET['app'] == 'login' ){
    if ( isset($_GET['type']) and $_GET['type'] == 'cerrar-session' ) {
        session_destroy();
        header( 'location: '.ADMIN_SITE );
    }
}

if( $bl->actual($v[1],$v[2]) ){

    $locals['model'] = $bl->model;
    if(isset($bl->model->name)) $locals['title'] = $bl->model->name_plural;
    if(isset($v[3]) and $v[3] == 'add') $locals['title'] = 'Añadir '.$bl->model->name;
    if(isset($v[3]) and is_numeric($v[3])) $locals['title'] = 'Modificar '.$bl->model->name;

    if(isset($_SESSION['add'])){
        $name = $_SESSION['add'];
        $locals['mensaje'] = 'Se agrego con éxito el '.$bloque.' "'.$name.'".';
        unset($_SESSION['add']);
    }elseif (isset($_SESSION['edit'])) {
        $name = $_SESSION['edit'];
        $locals['mensaje'] = 'Se modificó con éxito el '.$bloque.' "'.$name.'".';
        unset($_SESSION['edit']);
    }elseif (isset($_SESSION['delete'])) {
        $name = $_SESSION['delete'];
        $locals['mensaje'] = 'Se elimino con éxito el '.$bloque.' "'.$name.'".';
        unset($_SESSION['delete']);
    }

    // tipo de accion de se va a realizar
    if ($v[1] == 'home') {
        $locals['title'] = 'Inicio';
        $locals['app_list'] = $bl->app_list;
        //MUESTRA LISTADO INICIO
        echo $twig->render('home.html', $locals );
    }else{
        if ( $bl->app == 2 ) {
            // LLAMA AL MODELO
            if (file_exists(MODEL.$v[1].'/'.$v[2].'.php')) {
                include MODEL.$v[1].'/'.$v[2].'.php';
            }else{
                $locals['mensaje'] =  'No se a creado el modelo para "'.$locals['title'].'"';
            }
            // LLAMA AL CONTROLADOR
            if (file_exists(CONTROLLER.$v[1].'/'.$v[2].'.php')) {
                include CONTROLLER.$v[1].'/'.$v[2].'.php';
            }else{
                $locals['mensaje'] =  'No se a creado el controlador para "'.$locals['title'].'"';
            }

            if(isset($locals['mensaje'])) echo $twig->render('mensaje.html', $locals );
        }elseif ( $bl->app == 1 ) {
            // LISTADO INTERNO DE DIRECTORIO
            $locals['models'] = $bl->modulos($v[1]);
            if(isset($bl->model['name'])) $locals['title'] = 'Administración de '.$bl->model['name'];
            // LLAMA VISTA
            echo $twig->render('bloque.html', $locals );
        }else {
            // NO CUMPLE CON LOS DEMAS REQUISITOS
            echo "<h1>Sitio no disponible.</h1>";
        }
    }
}else{
    echo "<h1>Sitio no disponible.</h1>";
}
?>