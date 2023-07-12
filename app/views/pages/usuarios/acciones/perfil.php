<?php
$data = AddsController::getUsuarioById($idUsuario);
$selectTipoDocumentoCarga = AddsController::selectTipoDocumentoCarga();
$files = AddsController::selectFilesById($idUsuario);
?>

<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php include 'PerfilColumnaUno.php'; ?>
                <?php require 'PerfilColumnaDos.php'; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">Cargar archivos de soporte</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <div class="form-group">

                        <div class="row">

                            <div class="col">
                                <label> Tipo de documento</label>
                                <?php echo $selectTipoDocumentoCarga ?> 

                                <label> Número</label>
                                <input type="text" class="form-control" name="numero" value="">  

                            </div>

                            <div class="col">
                                <label> Descripción</label>
                                <input type="text" class="form-control" name="numero" value="">  

                                <label> Fecha de expedición</label>
                                <input type="text" class="form-control" id="fexpedicion" name="fexpedicion">

                                <label> Fecha de vencimiento</label>
                                <input type="text" class="form-control" id="fvencimiento" name="fvencimiento">

                                <input type="hidden" name="idusuario" value="<?php echo $data[0]->id_usuario ?>">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark">Aceptar</button>
                </div>
        </div>

        </form> 

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->






