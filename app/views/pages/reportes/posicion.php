<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            Posiciones para: <?php echo $deviceInformation[0]->name; ?>
            <br>
            Fecha inicial: <?php
            if (isset($fecha_inicio)) {
              echo date_format(date_create($fecha_inicio), 'Y-m-d H:i');
            } else {
              "";
            }
            ?>   
          </div>
          <div class="col-6">
            Distancia recorrida: <?php
            if (isset($reportsTrips[0])) {
              echo round($reportsTrips[0]->distance / 1000, 2) . 'kms.';
            } else {
              echo "";
            }
            ?>

            <br>
            Fecha final: <?php
            if (isset($fecha_fin)) {
              echo date_format(date_create($fecha_fin), 'Y-m-d H:i');
            } else {
              "";
            }
            ?>   
          </div>
        </div>
      </div>
    </div>
  </div>

  <form action="/reportes/posicion/" method='POST'>
    <div class="card card-solid">

      <div class="card-body pb-0">

        <div class="form-group">

          <div class="row justify-content-start">

            <div class="col-1">
              <label>Fecha Inicial</label>
            </div> 

            <div class="col-3">

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" name="fecha_inicio">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

            </div>

            <div class="col-1"><label>Fecha Final</label></div> 

            <div class="col-3">

              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" name="fecha_fin">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

            </div> 

            <div class="col-2">
              <input type="hidden" name="obtener_datos" value="1">
              <input type="hidden" name="id_dispositivo" value="<?php echo $idDispositivo ?>">
              <button type="submit" class="btn bg-dark float-right">Obtener datos</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>

<!-- Mapa ----------------------------------------------------------------- -->
<iframe 
  id='iframeMapa'
  src="../mapa/index.php?fi=<?php 
    echo $fecha_inicio ?>&ff=<?php 
    echo $fecha_fin ?>&id=<?php 
    echo $idDispositivo ?>" 
  width="100%" 
  height="460" 
  frameborder="0" 
  allowfullscreen></iframe>

<!-- Tabla ----------------------------------------------------------------- -->
<div style="height: 400px; overflow: auto;">
  <table id="positions" class="table table-bordered table-striped" >
    <thead>
      <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Velocidad (Km/h)</th>
        <th>Orientacion</th>
        <th>Evento</th>
      </tr>
    </thead>
    <tbody>
<?php for ($i = 0; $i < count($posiciones); $i++) { ?>
        <tr>
          <td><button type="button"  onclick="recargarIframe(event)" class="btn btn-primary btn-sm"><?php echo $posiciones[$i]->id ?></button>
            
            </td>
          <td><?php echo date_format(date_create($posiciones[$i]->deviceTime), 'Y-m-d'); ?></td>
          <td><?php echo date_format(date_create($posiciones[$i]->deviceTime), 'H:i:s'); ?></td>
          <td><?php echo round($posiciones[$i]->latitude, 5); ?></td>
          <td><?php echo round($posiciones[$i]->longitude, 5); ?></td>
          <td><?php echo $posiciones[$i]->speed ?></td>
          <td><?php echo courseFormatter($posiciones[$i]->course); ?></td>
          <td><?php echo $posiciones[$i]->speed == 0 ? 'Detenido' : 'Desplazamiento' ?></td>
        </tr>
<?php } ?>
    </tbody>
  </table>
</div>
<!-- // Tabla -------------------------------------------------------------- -->


<?php
if (isset($fecha_inicio)) {
  echo '<div class = "card-body">';
  $url = 'wsreports/reportegps/';
  $url .= $idDispositivo . '/';
  $url .= $fecha_inicio . '/';
  $url .= $fecha_fin;
  echo '<a class="btn btn-primary" href="' . $url . '" role="button" target="_blank">Ver informe</a>';
  echo '</div>';
}
?>

<script>

  function recargarIframe(event) {
    var pto = event.target.textContent;
    var fi = '<?php echo $fecha_inicio ?>';
    var ff = '<?php echo $fecha_fin ?>';
    var id = '<?php echo $idDispositivo ?>';
    var iframe = document.getElementById("iframeMapa");
    
    var url = "../mapa/index.php?";
    url += "fi=" + encodeURIComponent(fi);
    url += "&ff=" + encodeURIComponent(ff);
    url += "&id=" + encodeURIComponent(id);
    url += "&pto=" + encodeURIComponent(pto);
     
    iframe.src = url;
  }


  $(function () {
      $("#positions").DataTable({
          "lengthMenu": [50, 100, 200],
          "pageLength": 50,
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#positions_wrapper .col-md-6:eq(0)');
  });
</script>

