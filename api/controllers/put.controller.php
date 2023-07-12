<?php

require_once 'models/put.model.php';
require_once 'models/connection.php';

class PutController {

    // Peticion post para modificar r datos
    static public function putData( $table, $data, $id, $nameId ) {

        $response = PutModel::putData( $table, $data, $id, $nameId );

        $return = new PutController();
        $return->fncResponse( $response, null );
    }

    // Respuestas del controlador
    public function fncResponse( $response, $error ) {

        if ( !empty( $response ) ) {
            $json = array(
                'status' => 200,
                'result' => $response,
            );
        } else {

            if ( $error != null ) {
                $json = array(
                    'status' => 400,
                    'result' => $error,
                );
            } else {
                $json = array(
                    'status' => 404,
                    'result' => 'Not found',
                    'method' => 'put'
                );
            }

        }

        echo json_encode( $json, http_response_code( $json[ 'status' ] ) );
    }

}
