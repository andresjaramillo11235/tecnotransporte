<?php

require_once 'controllers/get.controller.php';

$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;

// Limit
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;


$response = new GetController();

if (isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {

    $linkTo = $_GET["linkTo"];
    $equalTo = $_GET["equalTo"];
    $response->getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
} else {

    // Peticiones Get sin filtro
    $response->getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}




