<?php

require_once 'connection.php';

class PutModel {

    // Peticion para modificar datos de forma dinamica
    static public function putData( $table, $data, $id, $nameId ) {

        $set = '';

        foreach ( $data as $key => $value ) {
            $set .= $key.'= :'.$key.',';
        }
        $set = substr( $set, 0, -1 );

        $sql = "UPDATE $table SET $set WHERE $nameId = :$nameId";
        $link = COnnection::connect();
        $stmt = $link->prepare( $sql );

        foreach ( $data as $key => $value ) {
            $stmt->bindParam( ':'.$key, $data[ $key ], PDO::PARAM_STR );
        }
        $stmt->bindParam( ':'.$nameId, $id, PDO::PARAM_STR );

        if ( $stmt->execute() ) {
            $response = array(
                'comment' => 'El registro fue modificado satisfactoriamente'
            );
            return $response;
        } else {
            return $link->errorInfo();
        }

    }
}
