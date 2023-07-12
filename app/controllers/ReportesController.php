<?php

include_once 'controllers/CurlTraccarController.php';

if (isset($routesArray[2])) {

  if ($routesArray[2] == 'gps') {
    // Recupera los dispositivos que estan en la plataforma
    //$url = 'positions?deviceId=1';
    $url = 'devices';
    $method = 'GET';

    $response = CurlTraccarController::request($url, $method);
  }

  if ($routesArray[2] == 'posicion') {

    if (isset($routesArray[3])) {
      $idDispositivo = $routesArray[3];
      $posiciones = array();
      $deviceInformation = getDeviceInformation($idDispositivo);
    }

    // Viene el formulario
    if (isset($_POST['obtener_datos'])) {
      $fi = explode(' ', $_POST['fecha_inicio']);
      $fecha_inicio = $fi[0] . 'T' . $fi[1] . ':00z';

      $ff = explode(' ', $_POST['fecha_fin']);
      $fecha_fin = $ff[0] . 'T' . $ff[1] . ':00z';
      $id_dispositivo = $_POST['id_dispositivo'];

      // Datos de posicion del movil
      $url = 'positions?';
      $url .= 'deviceId=' . $id_dispositivo;
      $url .= '&from=' . $fecha_inicio;
      $url .= '&to=' . $fecha_fin;

      $method = 'GET';
      $posiciones = CurlTraccarController::request($url, $method);
      $idDispositivo = $_POST['id_dispositivo'];
      $deviceInformation = getDeviceInformation($idDispositivo);

      $reportsTrips = getReportTrips($idDispositivo, $fecha_inicio, $fecha_fin);
    } else {
      $posiciones = array();
    }
  }
} else {
  //Include a not found
}

function getReportTrips($deviceId, $from, $to) {
  $url = 'reports/summary?';
  $url .= 'deviceId=' . $deviceId;
  $url .= '&from=' . $from;
  $url .= '&to=' . $to;

  $method = 'GET';
  $response = CurlTraccarController::request($url, $method);

  return $response;
}

function darFormatoFecha($fecha) {
  $dateString = $fecha;
  $date = strtotime($dateString);
  $formattedDate = date("d/m/Y H:i:s", $date);
  return $formattedDate;
}

function courseFormatter($value) {
  $courseValues = array('N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW');
  return $courseValues[floor($value / 45)];
}

// Recupera la informacion de un vehiculo
function getDeviceInformation($idDevice) {
  $url = 'devices?';
  $url .= 'id=' . $idDevice;

  $method = 'GET';
  $device = CurlTraccarController::request($url, $method);
  return $device;
}

