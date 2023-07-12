<?php

require_once 'controllers/curl.controller.php';

## Usuarios
$select = 'id_usuario,numero_documento_usuario,nombre_usuario,apellido_usuario,';
$select .= 'foto_usuario,numero_movil_usuario,direccion_usuario,correo_usuario';
$linkTo = 'linkTo=numero_documento_usuario&equalTo=159874122';
$limit = 'startAt=0&endAt=9';
$url = 'usuarios?select=' . $select . '&' . $limit;
$method = 'GET';
$fields = array();

$response = CurlController::request($url, $method, $fields);

if ($response->status == 200) {
    $data = $response->result;
} else {
    $data = array();
}

## Roles
$select_roles = 'id_usuario_rol,descripcion_usuario_rol';
$url_roles = 'usuarios_roles?select=' . $select_roles;
$method = 'GET';
$fields = array();

$response_roles = CurlController::request($url_roles, $method, $fields);

if ($response_roles->status == 200) {
    $data_roles = $response_roles->result;
} else {
    $data_roles = array();
}

$letras = range('a', 'z');

