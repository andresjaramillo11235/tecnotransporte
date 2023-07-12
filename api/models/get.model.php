<?php

require_once 'connection.php';

class GetModel {

    // Peticiones GET sin filtro
    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt) {

        // Validar la existencia de la tabla y de las columnas
        $selectArray = explode(',', $select);

        if (empty(Connection::getColumnsData($table, $selectArray))) {
            return null;
        }

        // Sin ordenar y sin limitar
        $sql = "SELECT $select FROM $table";

        // Ordenar sin limitar
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar datos sin ordenar
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table LIMIT $startAt, $endAt";
        }

        $stmt = connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // Peticiones GET con filtro
    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt) {

        // Validar la existencia de la tabla y las columnas
        $linkToArray = explode(",,", $linkTo);
        $selectArray = explode(',', $select);

        foreach ($linkToArray as $key => $value) {
            array_push($selectArray, $value);
        }

        $selectArray = array_unique($selectArray);

        if (empty(Connection::getColumnsData($table, $selectArray))) {
            return null;
        }

        $equalToArray = explode(",,", $equalTo);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        // Sin ordenar y limitar datos
        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

        // Ordenar datos sin limites
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode  LIMIT $startAt, $endAt";
        }

        // Limitar datos sin ordenar
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt, $endAt";
        }

        $stmt = connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {
            $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

}
