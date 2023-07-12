<?php
if (isset($routesArray[3])) {

  if ($routesArray[3] == 'crear') {
    $titulo = "Crear Usuario";
  }

  if ($routesArray[3] == 'contactos') {
    $titulo = "Usuarios";
  }

  if ($routesArray[3] == 'listar') {
    $titulo = "Listado de usuarios";
  }
  
  if ($routesArray[3] == 'perfil') {

    if (isset($routesArray[4]) && $routesArray[4] != 0) {
      $idUsuario = $routesArray[4];
    }

    $titulo = "Hoja de vida";
  }

  if ($routesArray[3] == 'cargar') {
    if (isset($routesArray[4]) && $routesArray[4] != 0) {
      $idUsuario = $routesArray[4];
    }
    $titulo = "Cargar Archivos";
  }
} else {
  $titulo = "Usuarios";
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $titulo ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            
            if (isset($routesArray[3])) {

              if ($routesArray[3] == 'perfil') {
                include 'controllers/AddsController.php';
                include 'acciones/perfil.php';
              }

              // Crear un nuevo usuario ========================================
              if ($routesArray[3] == 'crear') {
                include 'controllers/AddsController.php';
                include 'controllers/controller.php';
                include 'acciones/crear.php';
              }

              if ($routesArray[3] == 'modificar') {
                include 'controllers/AddsController.php';
                include 'acciones/' . $routesArray[3] . '.php';
              }

              if ($routesArray[3] == 'listar') {
                include 'acciones/listar.php';
              }
              
              // Cargar Archivos ===============================================
              if ($routesArray[3] == 'cargar') {
                include 'controllers/cargarArchivosController.php';
                include 'controllers/AddsController.php';
                include 'acciones/cargarArchivos.php';
              }
              
            } else {
              include 'controllers/contactos_usuarios_controller.php';
              include 'acciones/contactos.php';
            }
            ?>
        </div>
    </section>
    <!-- /.content -->
</div>
