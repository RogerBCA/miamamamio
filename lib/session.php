<?
session_start();
/* MENU */
$info = recogerDatos( 'SELECT * FROM store_infosite where id = 1;' );
$info = $info[0];

$dudas = recogerDatos( 'SELECT * FROM store_seccion where id = 13;' );
$dudas = $dudas[0];

$banner_lateral = recogerDatos( 'SELECT * FROM store_seccion where nick = \'banner_lateral\';' );
$banner_lateral = SeccionBanner( $banner_lateral );

$menu = 'SELECT id,name,slug FROM store_seccion WHERE parent_category_id=1 order by position desc';
$menu = recogerDatos( $menu );

$footer = 'SELECT id,name,url FROM store_seccion WHERE parent_category_id=15 order by position asc';
$footer = recogerDatos( $footer );

$bannerFooter = recogerDatos( 'SELECT * FROM store_banner where name = \'banner_footer\';' );
require_once 'class.inputfilter.php';
$ifilter = new InputFilter();
include 'lib/views.php';
?>