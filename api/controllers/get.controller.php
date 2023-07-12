<?php

require_once 'models/get.model.php';

class GetController {

    // Peticion sencilla sin filtro
    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt) {
        $response = GetModel::getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);

        $return = new GetController();
        $return->fncResponse($response);
    }

    // Peticiones con filtro
    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt) {


        $response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);

        $return = new GetController();
        $return->fncResponse($response);
    }

    // Da formato Json a los datos
    public function fncResponse($response) {

        if (!empty($response)) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'result' => $response,
            );
        } else {
            $json = array(
                'status' => 404,
                'result' => 'Not found',
            );
        }

        echo json_encode($json, http_response_code($json['status']));
    }

}
