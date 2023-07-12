<?php

header('Access-Control-Allow-Origin: *');

// Mostrar errores
ini_set( 'display_errors', 1 );
ini_set( 'log_errors', 1 );
//ini_set( 'error_log', 'c:/xampp/htdocs/tecnotransporte/php_error_log' );

require_once 'controllers/routes.controller.php';

$index = new RoutersController();
$index -> index();
