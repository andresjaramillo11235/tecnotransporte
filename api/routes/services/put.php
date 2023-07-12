<?php

require_once 'models/connection.php';
require_once 'controllers/put.controller.php';

if ( isset( $_GET[ 'id' ] ) && isset( $_GET[ 'nameId' ] ) ) {

    // Capturar datos del formulario
    $data = array();
    parse_str( file_get_contents( 'php://input' ), $data );

    // Separar las propiedades en un arreglo
    $columns = array();

    foreach ( array_keys( $data ) as $key => $value ) {
        array_push( $columns, $value );
    }

    // Validacion de la tabla y las columnas
    if ( empty( Connection::getColumnsData( $table, $columns ) ) ) {
        $json = array(
            'status' => 400,
            'results' => 'Error, los campos en el formulario no coinciden con la base de datos.'
        );

        echo json_encode( $json, http_response_code( $json[ 'status' ] ) );
        return;
    }

    // Solicitar respuesta del controlador
    $response = new PutController();
    $response->putData( $table, $data, $_GET[ 'id' ], $_GET[ 'nameId' ] );

}

