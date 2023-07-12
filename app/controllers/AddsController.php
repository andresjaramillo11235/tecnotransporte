<?php

class AddsController {

  static public function getUsuarioById($idUsuario) {

    $url = 'usuarios?select=*&linkTo=id_usuario&equalTo=' . $idUsuario;
    $method = 'GET';
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
      $response = $response->result;
    } else {
      $response = array();
    }

    return $response;
  }

  static public function selectRoles() {

    $url = 'usuarios_roles?select=id_usuario_rol,descripcion_usuario_rol';
    $method = 'GET';
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
      $response = $response->result;
    } else {
      $response = array();
    }

    $htm = '';
    $htm .= '<div class="form-group">';
    $htm .= '<label>Rol</label>';
    $htm .= '<select class = "form-control" name="usuario_rol">';

    foreach ($response as $key => $value) {
      $htm .= '<option value=' . $value->id_usuario_rol . '>';
      $htm .= $value->descripcion_usuario_rol;
      $htm .= '</option>';
    }

    $htm .= '</select>';
    $htm .= '</div>';

    return $htm;
  }

  static public function selectTipoDocumentoCarga() {

    $url = 'tipo_documento_carga?select=id_tipo_documento_carga,descripcion_tipo_documento_carga';
    $method = 'GET';
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
      $response = $response->result;
    } else {
      $response = array();
    }

    $htm = '';
    $htm .= '<div class="form-group">';
    $htm .= '<select class = "form-control" name="tipo_documento_carga">';

    foreach ($response as $key => $value) {
      $htm .= '<option value="' . $value->id_tipo_documento_carga . '" ';
      $htm .= $value->id_tipo_documento_carga == 41 ? 'selected' : '';
      $htm .= '>';
      $htm .= $value->descripcion_tipo_documento_carga;
      $htm .= '</option>';
    }

    $htm .= '</select>';
    $htm .= '</div>';

    return $htm;
  }

  static public function selectFilesById($idUsuario) {
    
    $url = 'usuarios_archivos?select=*&linkTo=id_usuario&equalTo=' . $idUsuario;
    $method = 'GET';
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
      $response = $response->result;
    } else {
      $response = array();
    }

    return $response;
    
  }

}
