<?php

function getTipoArchivo($id) {
  $url = 'tipo_documento_carga?select=descripcion_tipo_documento_carga&';
  $url .= 'linkTo=id_tipo_documento_carga&equalTo=' . $id;
  $method = 'GET';
  $fields = array();
  $response = CurlController::request($url, $method, $fields);
  return $response->result[0]->descripcion_tipo_documento_carga;
}
?>

<div class="tab-pane" id="archivos">
    <div class="form-group">
        <div class="row">
            <div class="card-body">
                <a href="usuarios/acciones/cargar/<?php echo $idUsuario ?>" 
                   class="btn btn-sm btn-primary btn-dark">
                    <i class="fas fa-user"></i> Cargar Soporte
                </a>
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <table id="usuarios" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Numero</th>
                            <th>Descripcion</th>
                            <th>Expedicion</th>
                            <th>Vencimiento</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $key => $value): ?>
                          <tr>
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php print_r(getTipoArchivo($value->tipo_documento)) ?></td>
                              <td><?php echo $value->numero_documento ?></td>
                              <td><?php echo $value->descripcion_archivo ?></td>
                              <td><?php echo $value->fecha_expedicion ?></td>
                              <td><?php echo $value->fecha_vencimiento ?></td>
                              <td>
                                  <?php
                                  $tmp = explode('.', $value->nombre_archivo);
                                  if ($tmp[1] === 'pdf') {
                                    $htm = '<embed class="pdf-preview" ';
                                    $htm .= 'src="views/files/' . $value->nombre_archivo . '" ';
                                    $htm .= 'type="application/pdf" width="100" height="200">';
                                  } else {
                                    $htm = '<img src="views/files/' . $value->nombre_archivo . '" ';
                                    $htm .= 'alt="Photo 1" class="img-fluid" ';
                                    $htm .= 'width="100" height="100">';
                                  }
                                  echo $htm;
                                  ?>
                              </td>
                          </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

