<?php

require_once 'get.model.php';

class Connection {

    // Info DB
    static public function infoDatabase() {

        $infoDB = array(
            'database' => 'grcgps',
            'user' => 'grcgps',
            'pws' => 'Grc0@@@mysql'
        );

        return $infoDB;
    }

    // Coneccion
    static public function connect() {

        try {
            $link = new PDO(
                    'mysql:host=localhost;dbname=' . Connection::infoDatabase()['database'],
                    Connection::infoDatabase()['user'],
                    Connection::infoDatabase()['pws']
            );

            $link->exec('set names utf8');
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        return $link;
    }

    /*
     * Validar la existencia de una tabla en la DB
     */

    static public function getColumnsData($table, $columns) {

        /*
         * Traer el nombre de la base de datos
         */

        $database = Connection::infoDatabase()['database'];

        /*
         * Traer todas las columnas de una tabla
         */

        $validate = Connection::connect()
                ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
                ->fetchAll(PDO::FETCH_OBJ);

        /*
         * Validar la existencia de la tabla
         */

        if (empty($validate)) {
            return null;
        } else {

            /*
             * Ajuste a solicitud de columnas globales cuando viene *
             */
            if ($columns[0] == '*') {
                array_shift($columns);
            }

            $sum = 0;

            foreach ($validate as $key => $value) {
                $sum += in_array($value->item, $columns);
            }

            return $sum == count($columns) ? $validate : null;
        }
    }

    // Generar token de autenticacion
    static public function jwt($id, $email) {

        $time = time();
        $token = array(
            'iat' => $time, // Tiempo presentede inicio del token
            'exp' => $time + ( 60 * 60 * 24 ), // Fecha de expiracion de un dia
            'data' => [
                'id' => $id,
                'email' => $email
            ]
        );

        return $token;
    }

    // Validar token
    static public function tokenValidate($token, $table, $suffix) {

        // Traer el usuario de acuerdo al token
        $user = GetModel::getDataFilter($table, '*', 'token_usuario', $token, null, null, null, null);
    }

}
