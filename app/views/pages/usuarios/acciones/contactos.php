<!-- Main content -->
<section class="content">
  <!-- Default box -->

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <a class="btn bg-dark btn-sm" href="/usuarios/acciones/crear">Nuevo Usuario</a>
      </h3>
    </div></div>

  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <select class="form-control" name="tdocumento">
              <option value="0">--Buscar por rol--</option>
              <option value="0">Todos los roles</option>
              <?php foreach ($data_roles as $key_rol => $value_rol) { ?>
                  <option value="<?php echo $value_rol->id_usuario_rol; ?>"><?php echo $value_rol->descripcion_usuario_rol; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <select class="form-control" name="tdocumento">
              <option value="0">--Buscar apellido por orden alfabético--</option>
              <?php for ($i = 0; $i < count($letras); $i++) { ?>
                  <option value="<?php echo $letras[$i]; ?>"><?php echo $letras[$i]; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="input-group-prepend">
              <input 
                  type="text" 
                  class="form-control" 
                  name="ndocumento"
                  value=""
                  placeholder="Buscar">

              <span class="input-group-text"><i class="fas fa-search" ></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">

        <?php foreach ($data as $key => $value) { ?>

            <!-- Inicio Card ---------------------------------------------------- -->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Conductor
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo ucwords($value->nombre_usuario) . ' ' . ucwords($value->apellido_usuario) ?></b></h2>

                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mail-bulk"></i></span> Correo: <?php echo $value->correo_usuario ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: <?php echo $value->direccion_usuario ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: <?php echo $value->numero_movil_usuario ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="views/img/users/<?php
                      echo $value->foto_usuario
                      ?>" alt="<?php
                           echo ucwords($value->nombre_usuario) . ' ' . ucwords($value->apellido_usuario)
                           ?>" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="usuarios/acciones/perfil/<?php
                    echo $value->id_usuario
                    ?>" class="btn btn-sm btn-primary btn-dark">
                      <i class="fas fa-user"></i> Hoja de vida
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin Card ---------------------------------------------------- -->

        <?php } ?>

      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">5</a></li>
          <li class="page-item"><a class="page-link" href="#">6</a></li>
          <li class="page-item"><a class="page-link" href="#">7</a></li>
          <li class="page-item"><a class="page-link" href="#">8</a></li>
        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</section>


