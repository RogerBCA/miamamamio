<?php
// tipo de accion de se va a realizar
$locals['datos']['active'] = true;
switch ($type) {
    case 'listar':
        $locals['app']['listar'] = $app->listar();
        $locals['app']['total'] = $app->total;
        echo $twig->render($template_app.'list.html', $locals );
        break;
    case 'add':
        $locals['edit'] = false;
        if( isset($POST['_save']) || isset($POST['_addanother']) || isset($POST['_continue']) ){
            $app->insertar($POST);
            $locals['datos'] = $app->datos;
            $locals['errors'] = $app->errors;
            if( $app->errors == false ){
                if(isset($_POST['_save'])) header('location: '.$locals['model']->admin_url);
                if(isset($_POST['_addanother'])) header('location: '.$locals['model']->admin_url.'add/');
                if(isset($_POST['_continue'])) header('location: '.$locals['model']->admin_url.$app->devolverID.'/');
            }
        }else{
            // Valores por defecto
            $locals['datos']['position'] = 1;
        }
        // printQuery($locals);
        echo $twig->render($template_app.'app.html', $locals );

        break;
    case 'edit':
        if(is_numeric($v[3])){
            $locals['edit'] = true;
            if( isset($POST['_save']) || isset($POST['_addanother']) || isset($POST['_continue']) ){
                $app->actualizar($POST,$v[3]);
                $locals['datos'] = $app->datos;
                $locals['errors'] = $app->errors;
                if( $app->errors == false ){
                    if(isset($_POST['_save'])) header('location: '.$locals['model']->admin_url);
                    if(isset($_POST['_addanother'])) header('location: '.$locals['model']->admin_url.'add/');
                    if(isset($_POST['_continue'])) header('location: '.$locals['model']->admin_url.$v[3].'/');
                }
            }else{
                // Valores por defecto
                $locals['datos'] = $app->ver($v[3]);
            }
            echo $twig->render($template_app.'app.html', $locals );
        }
        break;
    case 'delete':
        if(is_numeric($v[3])){
            $locals['title'] = '¿Está seguro?';
            $locals['datos'] = $app->ver($v[3]);
            if ( isset($POST['post']) and $POST['post'] == 'yes' ) {
                $app->eliminar($v[3]);
                header('location: '.$locals['model']->admin_url);
            }
            echo $twig->render($template_app.'delete.html', $locals );
        }
        break;
    default:

        break;
}
?>