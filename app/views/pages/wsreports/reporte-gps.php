<?php

$diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
include_once 'controllers/CurlTraccarController.php';

$idDispositivo = $routesArray[3];
$fechaInicio = $routesArray[4];
$fechaFin = $routesArray[5];

$url = 'positions?';
$url .= 'deviceId=' . $idDispositivo;
$url .= '&from=' . $fechaInicio;
$url .= '&to=' . $fechaFin;

$method = 'GET';
$posiciones = CurlTraccarController::request($url, $method);
$infoVehiculo = getDeviceInformation($idDispositivo);
?>

<script src="print.js"></script>

<div style="text-align: center; margin-top: 10px">
  <button class="btn btn-danger" onclick="printJS(
      { printable: 'printable-area',
      type: 'html',
      css:[
          'views/assets/plugins/adminlte/css/adminlte.min.css',
      ],
      style: '.hideOnPrint { display:none; }'
      })"><i class="fa fa-file-pdf"></i>
    Exportar
  </button>
</div>

<div id="printable-area">
<div class="wrapper" style="margin: 10px">
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col">
            <img src="views/img/logo-grc.jpeg" width="192" height="106" alt="GRC"/>
          </div>
          <div class="col" style="text-align: right">
            <h5>GESTION RIESGO CONTROL INTEGRAL SAS</h5> 
            <h5>3186000000 <i class="fas fa-phone" ></i></h5>
            <h5>http://www.grc-gps.com <i class="fas fa-globe" ></i></h5>
          </div>
        </div>
        <div style="text-align: center">
          <h4>Informe de posiciones</h4>
          <h2><?php echo $infoVehiculo[0]->name?></h2>
          <h4>
            desde:
            <?php echo date_format(date_create($fechaInicio), 'Y-m-d H:i')?>
            hasta
            <?php echo date_format(date_create($fechaFin), 'Y-m-d H:i')?>
          </h4>
        </div>
        <div class="row">
          <div class="col">
            <h5>Bogotá D.C, <?php echo $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;?></h5> 
            <h5>Señores: Grc Gps</h5>
            <h5>Distancia recorrida en el periodo:</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="positions" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 18%;">Dirección</th>
              <th style="width: 12%;">Fecha</th>
              <th>Hora</th>
              <th>Latitud</th>
              <th>Longitud</th>
              <th>Velocidad (Km/h)</th>
              <th>Distancia (Km)</th>
              <th>Orientacion</th>
              <th>Evento</th>
            </tr>
          </thead>
          <tbody>
              <?php for ($i = 0; $i < count($posiciones); $i++) { ?>
              <tr>
                <td>
                  <a href="https://maps.google.com/maps?q=<?php 
                    echo $posiciones[$i]->latitude .','. $posiciones[$i]->longitude ?>" target="_blank"><?php 
                    echo round($posiciones[$i]->latitude, 5).' / '.round($posiciones[$i]->longitude, 5) ?>
                  </a>
                </td>
                <td><?php echo date_format(date_create($posiciones[$i]->deviceTime), 'Y-m-d'); ?></td>
                <td><?php echo date_format(date_create($posiciones[$i]->deviceTime), 'H:i:s'); ?></td>
                <td><?php echo round($posiciones[$i]->latitude, 5); ?></td>
                <td><?php echo round($posiciones[$i]->longitude, 5); ?></td>
                <td><?php echo nudosAKilometrosPorHora($posiciones[$i]->speed) ?></td>
                <td><?php echo metrosAKilometros($posiciones[$i]->attributes->distance) ?></td>
                <td><?php echo courseFormatter($posiciones[$i]->course); ?></td>
                <td><?php echo $posiciones[$i]->speed == 0 ? 'Detenido' : 'Desplazamiento' ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        Footer
      </div>
    </div>
  </section>
</div>
</div>

<?php

function courseFormatter($value) {
  $courseValues = array('N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW');
  return $courseValues[floor($value / 45)];
}

function getDeviceInformation($idDevice) {
  $url = 'devices?';
  $url .= 'id=' . $idDevice;
  $method = 'GET';
  $device = CurlTraccarController::request($url, $method);
  return $device;
}

function metrosAKilometros($metros) {
    $kilometros = $metros / 1000; 
    return $kilometros;
}

function nudosAKilometrosPorHora($nudos) {
    $kilometrosPorHora = round($nudos * 1.852, 1);
    return $kilometrosPorHora;
}


