<?php
include 'controllers/ReportesController.php';
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>
              <?php
              if (isset($routesArray[2])) {
                  if ($routesArray[2] == 'gps') {
                      echo 'Reportes GPS';
                  }
                  if ($routesArray[2] == 'posicion') {
                      echo 'Posición del vehículo';
                  }
              }
              ?>
          </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
            <?php
            if (isset($routesArray[2])) {
                if ($routesArray[2] == 'gps') {
                    echo '<li class="breadcrumb-item active">Reportes GPS</li>';
                }
                if ($routesArray[2] == 'posicion') {
                    echo '<li class="breadcrumb-item"><a href="/reportes/gps">Reportes GPS</a></li>';
                    echo '<li class="breadcrumb-item active">Posición del vehículo</li>';
                }
            }
            ?>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php
          if (isset($routesArray[2])) {
            if ($routesArray[2] == 'gps' || $routesArray[2] == 'posicion') {
                include $routesArray[2] . '.php';
            }
          } else {
              //include 'reportes.php';
          }
          ?>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>