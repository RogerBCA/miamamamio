<?php
if( $v[3] == ''){
    $type = 'listar';
}elseif ( $v[3] == 'add' ) {
    $type = 'add';
}elseif ( is_numeric($v[3]) ) {
    $type = 'edit';
}

if (isset($v[4]) and $v[4] == 'delete' ) {
    $type = 'delete';
}

$app = new app;
$template_app = 'bloques/grupo/';
$locals['choice1'] = $app->choice1;
include CONTROLLER.'app.php';
?>