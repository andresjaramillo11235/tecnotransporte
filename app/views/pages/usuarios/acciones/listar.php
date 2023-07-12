<?php
$select = 'numero_documento_usuario,nombre_usuario,apellido_usuario';
$linkTo = 'linkTo=numero_documento_usuario&equalTo=159874122';
$url = 'usuarios?select=' . $select;
$method = 'GET';
$fields = array();

$response = CurlController::request($url, $method, $fields);

if ($response->status == 200) {
    $response = $response->result;
} else {
    $response = array();
}
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a class="btn bg-dark btn-sm" href="/usuarios/acciones/crear">Nuevo Usuario</a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="usuarios" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($response as $key => $value): ?>

                    <tr>
                        <td><?php echo ($key + 1) ?></td>
                        <td><?php echo $value->numero_documento_usuario ?></td>
                        <td><?php echo $value->nombre_usuario ?></td>
                        <td><?php echo $value->apellido_usuario ?></td>
                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- Page specific script -->
<script>
    $(function () {
        $("#usuarios").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#usuarios_wrapper .col-md-6:eq(0)');
    });
</script>