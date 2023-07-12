<!-- /.primera columna -------------------------------------------------- -->
<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="views/img/users/<?php echo $data[0]->foto_usuario ?>"
                     alt="<?php
                     echo ucwords($data[0]->nombre_usuario) . ' ' . ucwords($data[0]->apellido_usuario)
                     ?>">
            </div>

            <!-- Nombre -->
            <h3 class="profile-username text-center"><?php
                echo ucwords($data[0]->nombre_usuario);
                ?> <?php
                echo ucwords($data[0]->apellido_usuario);
                ?></h3>

            <!-- Perfil -->
            <p class="text-muted text-center">Conductor</p>

            <div class="text-center">
                <a href="#" class="btn btn-dark">
                    <i class="fas fa-pencil-alt"></i> Modificar
                </a>
                <a href="#" class="btn btn-dark">
                    <i class="fas fa-download"></i> Generar PDF
                </a>
            </div>

            <br>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- About Me Box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Datos personales</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <strong><i class="fas fa-phone mr-1"></i> Teléfono</strong>
            <p class="text-muted"><?php echo $data[0]->numero_movil_usuario ?></p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>
            <p class="text-muted"><?php echo $data[0]->direccion_usuario ?></p>

            <hr>

            <strong><i class="fas fa-envelope mr-1"></i> Correo</strong>
            <p class="text-muted"><?php echo $data[0]->correo_usuario ?></p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Comentarios</strong>
            <p class="text-muted"><?php
                echo $data[0]->comentario_usuario
                ?></p>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.primera columna --------------------------------------------------- -->
