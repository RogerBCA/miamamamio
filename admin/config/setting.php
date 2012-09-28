<?php
/////////////////////////////////
// rutas de acceso
///////////////////////////////// 
DEFINE("root", $_SERVER["DOCUMENT_ROOT"]);              // raíz
DEFINE("self", $_SERVER["PHP_SELF"]);                   // directiva SELF

/////////////////////////////////////////
// CONTROLES DE DIRECTORIOS
/////////////////////////////////////////
DEFINE("SITE", 'http://'.$_SERVER['SERVER_NAME']);
// sin htaccess
// DEFINE("SITE_URL", SITE.'/index.php/');
// DEFINE("ADMIN_SITE", SITE.'/admin/index.php/');
// con htaccess
DEFINE("SITE_URL", SITE.'/');
DEFINE("ADMIN_SITE", SITE.'/admin/');

DEFINE("CONTROLLER", 'controller/bloques/');
DEFINE("MODEL", 'model/bloques/');
DEFINE("VIEW", 'view/bloques/');
DEFINE("TEMPLATE", 'template');
DEFINE("STATIC_URL", SITE.'/static/');
/////////////////////////////////////////
// Base de datos
/////////////////////////////////////////
DEFINE("tipo_db", "mysql");                             // tipo de base de datos
DEFINE("servidor","localhost");                         // servidor
DEFINE("dbase","luiggi_mmm");                             // Nombre de la base de datos
DEFINE("PREFIX","app_");

/////////////////////////////////////////
// Usuario privilegiado
/////////////////////////////////////////
DEFINE("usuario","luiggi_mmm");
DEFINE("clave","mmmroot");
DEFINE("mail_postmaster","info@rogerca.com");

/////////////////////////////////////////
// Tiempo de expiración
/////////////////////////////////////////
DEFINE("tiempo_expiracion",1000);
DEFINE("tiempo_expiracion_login",450);

/////////////////////////////////////////
// No Cache
/////////////////////////////////////////
DEFINE("nocache",true);

/////////////////////////////////////////
// Cliente
/////////////////////////////////////////
DEFINE("app_name","MiaMamaMio");
?>