<?php

require_once 'models/connection.php';
require_once 'controllers/post.controller.php';

if (isset($_POST)) {

    $columns = array();

    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }

    // Validacion de la tabla y las columnas
    if (empty(Connection::getColumnsData($table, $columns))) {
        $json = array(
            'status' => 400,
            'results' => 'Error, los campos en el formulario no coinciden con la base de datos.'
        );

        echo json_encode($json, http_response_code($json['status']));
    }

    $response = new PostController();

    // Peticion post para el registro de usuarios
    if (isset($_GET['register']) && $_GET['register'] == true) {

        $suffix = $_GET['suffix'] ?? 'user';
        $response->postRegister($table, $_POST, $suffix);
    }

    // Login
    elseif (isset($_GET['login']) && $_GET['login'] == true) {

        $suffix = $_GET['suffix'] ?? 'user';
        $response->postLogin($table, $_POST, $suffix);
    } else {

        // Peticion post para usuarios autorizados
        /*
          if ( $_GET[ 'token' ] ) {

          $table = 'usuarios';
          $suffix = 'usuario';

          $validate = Connection::tokenValidate( $_GET[ 'token' ], $table, $suffix );
          }

         */

        $response->postData($table, $_POST);

        // Solicitar respuesta del controlador para crear datos en cualquier tabla
    }
}
