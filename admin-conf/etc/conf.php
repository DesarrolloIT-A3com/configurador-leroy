<?php

// ESTABLECEMOS ZONA HORARIA
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_TIME, 'es_ES.UTF-8');
setlocale(LC_NUMERIC, 'C');

// DATOS PARA LA CONEXIÓN DE LA BASE DE DATOS
//define("SERVER","localhost");
//define("USER","novalkes_arjomy-leroy");
//define("PASS","6hDDbrGpbILd");
//define("DB","novalkes_arjomy-leroy");

// DATOS PARA LA CONEXIÓN DE LA BASE DE DATOS
define("SERVER","POAPMYSQL118.dns-servicio.com");
define("USER","arjomy-user-a3");
define("PASS","a3com@2022");
define("DB","8432940_arjomy-17-10-22");

// PARA QUE MUESTRE LOS ERRORES
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
jimenezdomenech@yahoo.es