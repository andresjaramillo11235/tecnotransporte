<?php

require_once 'models/get.model.php';
require_once 'models/post.model.php';
require_once 'models/put.model.php';
require_once 'models/connection.php';

require_once 'vendor/autoload.php';

use Firebase\JWT\JWT;

class PostController {

    // Peticion post para crear datos
    static public function postData($table, $data) {

        $response = PostModel::postData($table, $data);

        $return = new PostController();
        $return->fncResponse($response, null);
    }

    // Login
    static public function postLogin($table, $data, $suffix) {

        // validar que el usuario exista en la DB
        $response = GetModel::getDataFilter($table, '*', 'email_' . $suffix, $data['email_' . $suffix], null, null, null, null);

        if (!empty($response)) {

            // Encriptar la contrasena
            $crypt = crypt($data['password_' . $suffix], '$2a$07$tecnotransporte11235813$');

            if ($response[0]->{'password_' . $suffix} == $crypt) {

                $token = Connection::jwt($response[0]->{'id_' . $suffix}, $response[0]->{'email_' . $suffix});

                $algorithm = 'HS256';
                $jwt = jwt::encode($token, 'tecnotransporte11235813', $algorithm);

                $data = array(
                    'token_' . $suffix => $jwt,
                    'token_exp_' . $suffix => $token['exp']
                );

                // Actualizar la base de datos con el token
                $update = PutModel::putData($table, $data, $response[0]->{'id_' . $suffix}, 'id_' . $suffix);

                if (isset($update['comment']) && $update['comment'] == 'El registro fue modificado satisfactoriamente') {
                    $response[0]->{'token_' . $suffix} = $jwt;
                    $response[0]->{'token_exp_' . $suffix} = $token['exp'];

                    $return = new PostController();
                    $return->fncResponse($response, null);
                }
            } else {

                $response = null;
                $return = new PostController();
                $return->fncResponse($response, 'Usuario no encontrado');
            }
        } else {

            $response = null;
            $return = new PostController();
            $return->fncResponse($response, 'Usuario no encontrado');
        }
    }

    static public function postRegister($table, $data, $suffix) {

        if (isset($data['password_' . $suffix]) && $data['password_' . $suffix] != null) {
            $crypt = crypt($data['password_' . $suffix], '$2a$07$tecnotransporte11235813$');
            $data['password_' . $suffix] = $crypt;

            $response = PostModel::postData($table, $data);

            $return = new PostController();
            $return->fncResponse($response, null);
        }
    }

    // Da formato Json a los datos
    public function fncResponse($response, $error) {

        if (!empty($response)) {

            $json = array(
                'status' => 200,
                'result' => $response,
            );
        } else {

            if ($error != null) {
                $json = array(
                    'status' => 400,
                    'result' => $error,
                );
            } else {
                $json = array(
                    'status' => 404,
                    'result' => 'Not found',
                    'method' => 'post'
                );
            }
        }

        echo json_encode($json, http_response_code($json['status']));
    }

}
