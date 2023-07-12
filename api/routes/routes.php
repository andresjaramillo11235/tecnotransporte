<?php

$routesArray = explode( '/', $_SERVER[ 'REQUEST_URI' ] );
$routesArray = array_filter( $routesArray );

// No hay peticiones a la API
if ( count( $routesArray ) == 0 ) {
    $json = array(
        'status' => 404,
        'result' => 'Not found',
    );

    echo json_encode( $json, http_response_code( $json[ 'status' ] ) );

    return;
}

/*
* Cuando se hace una peticion a la API
*/
if ( count( $routesArray ) == 1 && isset( $_SERVER[ 'REQUEST_METHOD' ] ) ) {

    $table = explode( '?', $routesArray[ 1 ] )[ 0 ];

    // Peticiones GET
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
        include 'services/get.php';
    }

    // Peticiones POST
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        include 'services/post.php';
    }

    // Peticiones PUT
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'PUT' ) {
        include 'services/put.php';
    }

    // Peticiones DELETE
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'DELETE' ) {
        $json = array(
            'status' => 200,
            'result' => 'Success DELETE',
        );

        echo json_encode( $json, http_response_code( $json[ 'status' ] ) );
    }
}

