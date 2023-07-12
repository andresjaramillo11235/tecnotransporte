<!-- /.card-header -->
<div class="card-body">
  <table id="devices" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Placa</th>
        <th>Primer registro</th>
        <th>Ultimo registro</th>
        <th>Km registrado por GPS</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($response); $i++) {

            // Datos de la ultima posicion del movil
            $url = 'positions?deviceId=' . $response[$i]->id;
            //$url = 'positions';
            $method = 'GET';
            $posicion = CurlTraccarController::request($url, $method);
            
            //print_r($posicion);
            
            ?>

          <tr>
            <td><?php echo $response[$i]->id ?></td>
            <td><?php echo $response[$i]->name ?></td>
            <td><?php echo date_format(date_create($response[$i]->lastUpdate), 'Y-m-d H:i:s'); ?></td>
            <td><?php echo date_format(date_create($response[$i]->lastUpdate), 'Y-m-d H:i:s'); ?></td>
            <td><?php echo $response[$i]->name ?></td>
            <td>
              <a href="/reportes/posicion/<?php echo $response[$i]->id ?>" class="btn btn-dark btn-sm" role="button" aria-pressed="true">Posiciones</a>
            </td>
          </tr>

      <?php } ?>
    </tbody>

  </table>
</div>
<!-- /.card-body -->

<!-- Page specific script -->
<script>
    $(function () {
        $("#devices").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#devices_wrapper .col-md-6:eq(0)');
    });
</script>