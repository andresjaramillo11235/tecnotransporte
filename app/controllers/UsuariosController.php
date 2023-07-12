<?php

//require_once 'controllers/curl.controller.php';
require_once 'controllers/Validator.php';

// Validar los campos obligatorios
$isFormValid = true;

## Validacion del numero de documento
if ( isset( $_POST[ 'ndocumento' ] ) && empty( $_POST[ 'ndocumento' ] ) ) {
    $isFormValid = false;
    $textoErrorDocumento = 'Debe ingresar un número de documento';
} else {
    if ( is_numeric( $_POST[ 'ndocumento' ] ) && strlen( $_POST[ 'ndocumento' ] ) > 3 ) {

        $select = 'numero_documento_usuario';
        $linkTo = 'linkTo=numero_documento_usuario&equalTo=' . $_POST[ 'ndocumento' ];
        $url = 'usuarios?select=' . $select . '&' . $linkTo;
        $method = 'GET';
        $fields = array();

        $response = CurlController::request( $url, $method, $fields );

        if ( $response->status == 200 ) {
            $isFormValid = false;
            $textoErrorDocumento = 'El número de documento ya existe';
        }

        // Valida en la base de datos si el documento existe
    } else {
        $isFormValid = false;
        $textoErrorDocumento = 'Debe ingresar un número de documento válido';
    }
}

## Validacion del nombre
if ( empty( $_POST[ 'nusuario' ] ) &&  !preg_match( '/^[A-Za-zñÑáéíóúÁÉÍÓÚ 1-9]{2,}$/', $_POST[ 'nusuario' ] ) ) {
    $isFormValid = false;
    $errorNombre = 'Debe ingresar un nombre válido';
}

## Validacion del tipo de documento
if ( isset( $_POST[ 'tdocumento' ] ) && $_POST[ 'tdocumento' ] == '0' ) {
    $isFormValid = false;
    $textoErrorTipoDocumento = 'Debe seleccionar un tipo de documento';
}

## Validacion del tipo de usuario
if ( isset( $_POST[ 'tusuario' ] ) && $_POST[ 'tusuario' ] == '0' ) {
    $isFormValid = false;
    $errorTipoUsuario = 'Debe seleccionar un tipo de usuario';
}

## Validacion Correo electronico
if ( isset( $_POST[ 'correo' ] ) && $_POST[ 'correo' ] != '' ) {
    if ( !preg_match( '/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST[ 'correo' ] ) ) {
        $isFormValid = false;
        $errorCorreo = 'Debe ingresar un correo válido';
    }
}

## Validacion de la contraseña
if ( isset( $_POST[ 'pwsuno' ] ) && empty( $_POST[ 'pwsuno' ] ) ) {
    $isFormValid = false;
    $errorPwsUno = 'Debe ingresar una contraseña';
} else {
    if ( isset( $_POST[ 'pwsdos' ] ) && empty( $_POST[ 'pwsdos' ] ) ) {
        $isFormValid = false;
        $errorPwsDos = 'Debe confirmar la contraseña';
    } else {
        if ( !( $_POST[ 'pwsuno' ] === $_POST[ 'pwsdos' ] ) ) {
            $isFormValid = false;
            $errorPwsDos = 'Las contraseñas no coinciden';
        }
    }
}

$grabarFoto = false;
## Validacion de la foto
if ( isset( $_FILES[ 'foto' ][ 'name' ] ) && $_FILES[ 'foto' ][ 'name' ] != '' ) {
    // Validar que se trata de un JPG/GIF/PNG

    $allowedExts = array( 'jpg', 'jpeg', 'gif', 'png', 'JPG', 'GIF', 'PNG' );
    $e = explode( '.', $_FILES[ 'foto' ][ 'name' ] );
    $extension = end( $e );

    if ( ( ( $_FILES[ 'foto' ][ 'type' ] == 'image/gif' ) ||
    ( $_FILES[ 'foto' ][ 'type' ] == 'image/jpeg' ) ||
    ( $_FILES[ 'foto' ][ 'type' ] == 'image/png' ) ||
    ( $_FILES[ 'foto' ][ 'type' ] == 'image/pjpeg' ) ) && in_array( $extension, $allowedExts ) ) {
        // el archivo es un JPG/GIF/PNG, entonces...

        $n = explode( '.', $_FILES[ 'foto' ][ 'name' ] );
        $extension = end( $n );
        //$foto = substr( md5( uniqid( rand() ) ), 0, 10 ) . '.' . $extension;
        //$foto = $_POST[ 'ndocumento' ] . '.' . $extension;
        $foto = $_POST[ 'ndocumento' ];
        $directorio = 'views/img/users';

        $grabarFoto = true;

    } else {
        // El archivo no es JPG/GIF/PNG
        $isFormValid = false;
        $errorFoto = 'Debe seleccionar un tipo de usuario';
    }

}

if ( $isFormValid ) {
    // Agrupar la información
    $data = array(
        'tipo_documento_usuario' => $_POST[ 'tdocumento' ],
        'numero_documento_usuario' => $_POST[ 'ndocumento' ],
        'tipo_usuario' => $_POST[ 'tusuario' ],
        'nombre_usuario' => trim( strtolower( $_POST[ 'nusuario' ] ) ),
        'apellido_usuario' => trim( strtolower( $_POST[ 'ausuario' ] ) ),
        'correo_usuario' => trim( strtolower( $_POST[ 'correo' ] ) ),
        'email_usuario' => trim( strtolower( $_POST[ 'ndocumento' ] . '@correo.com' ) ),
        'password_usuario' => trim( $_POST[ 'pwsuno' ] ),
        'sexo_usuario' => $_POST[ 'sexo' ],
        'fecha_creacion_usuario' => date( 'Y-m-d' ),
        'direccion_usuario' => trim( $_POST[ 'direccion' ] ),
        'numero_movil_usuario' => trim( $_POST[ 'telmovil' ] ),
        'numero_fijo_usuario' => trim( $_POST[ 'telfijo' ] ),
        'fecha_nacimiento_usuario' => trim( $_POST[ 'fnacimiento' ] ),
        'lugar_nacimiento_usuario' => trim( $_POST[ 'lnacimiento' ] ),
        'estrato_social_usuario' => $_POST[ 'esocial' ],
        'foto_usuario' => isset( $foto ) ? 'res_' . $foto . '.' . $extension : 'res_defecto_hombre.png',
        'factor_rh_usuario' => $_POST[ 'frhuno' ] . ' ' . $_POST[ 'frhdos' ],
        'eps_usuario' => trim( $_POST[ 'eps' ] ),
        'tipo_ocupacion_usuario' => $_POST[ 'ocupacion' ],
        'estado_civil_usuario' => $_POST[ 'ecivil' ],
        'nivel_educativo_usuario' => $_POST[ 'neducativo' ],
        'discapacidad_usuario' => trim( $_POST[ 'discapacidad' ] ),
        'alergia_usuario' => trim( $_POST[ 'alergias' ] ),
        'detalle_alergia_usuario' => $_POST[ 'dalergias' ],
        'comentario_usuario' => $_POST[ 'comentarios' ],
        'informacion_contacto_usuario' => $_POST[ 'infocontacto' ],
        'numero_runt_usuario' => $_POST[ 'numero_runt' ],
        'tipo_licencia_carro_usuario' => $_POST[ 'tipo_licencia_carro' ],
        'fecha_inscripcion_runt_usuario' => $_POST[ 'fecha_inscripcion_runt' ],
        'vigencia_licencia_carro_usuario' => $_POST[ 'vigencia_licencia_carro' ],
        'tipo_licencia_moto_usuario' => $_POST[ 'tipo_licencia_moto' ],
        'vigencia_licencia_moto_usuario' => $_POST[ 'vigencia_licencia_moto' ],
        'anios_experiencia_usuario' => $_POST[ 'anios_experiencia' ],
        'id_rol_usuario' => $_POST[ 'usuario_rol' ]
    );

    // Solicitud a la API
    $url = 'usuarios?register=true&suffix=usuario';
    $method = 'POST';
    $fields = $data;

    $response = CurlController::request( $url, $method, $fields );

    // Respuesta de la API
    if ( $response->status == 200 ) {
        if ( $grabarFoto ) {
            grabarImagen( $_FILES, $foto, $directorio, $extension );
        }
        $confirmacion = true;
        $idUsuario = $response->result->lastId;
    }
}
