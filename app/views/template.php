<?php
session_start();

$routes_Array = explode('/', $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routes_Array);

//Limpiar url de variables get
foreach ($routesArray as $key => $value) {
  $value = explode('?', $value)[0];
  $routesArray[$key] = $value;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TecnoTransporte</title>

    <base href="<?php echo TemplateController::path() ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="views/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/assets/plugins/adminlte/css/adminlte.min.css">
    <!-- Theme custom -->
    <link rel="stylesheet" href="views/assets/custom/template/template.css">

    <!-- InputMask -->        
    <script src="views/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- jQuery -->
    <script src="views/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="views/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="views/assets/plugins/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/assets/plugins/adminlte/js/adminlte.min.js"></script>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <!-- Material Preloader -->
    <!-- https://www.jqueryscript.net/loading/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3.html -->
    <script src="views/assets/plugins/material-preloader/material-preloader.js"></script>
    <!-- Notie Alert -->
    <!-- https://jaredreich.com/notie/ -->
    <!-- https://github.com/jaredreich/notie -->
    <script src="views/assets/plugins/notie/notie.min.js"></script>

    <!-- Sweet Alert -->
    <!-- https://sweetalert2.github.io/ -->
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="views/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

    <link rel="stylesheet" href="views/assets/custom/template/template.css" type="text/css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Mapa -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script type="module" src="views/assets/maps/map.js"></script>

    <script>
      $(function () {
          $('input[name="fecha_inicio"]').daterangepicker({
              timePicker: true,
              timePicker24Hour: true,
              startDate: moment().startOf('hour'),
              //endDate: moment().startOf('hour').add(6, 'hour'),

              "singleDatePicker": true,
              locale: {
                  format: 'YYYY-MM-DD HH:mm'
              }
          });
          $('input[name="fecha_fin"]').daterangepicker({
              timePicker: true,
              timePicker24Hour: true,
              startDate: moment().startOf('hour').add(1, 'hour'),
              //endDate: moment().startOf('hour').add(1, 'hour'),
              "singleDatePicker": true,
              locale: {
                  format: 'YYYY-MM-DD HH:mm'
              }
          });
      });
      $(function () {
          $("#fexpedicion").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "2000:2030"
          });
      });
      $(function () {
          $("#fvencimiento").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "2000:2030"
          });
      });
      $(function () {
          $("#datepicker").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "1931:2010"
          });
      });
      $(function () {
          $("#fecha_inscripcion_runt").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "1960:2023"
          });
      });
      $(function () {
          $("#vigencia_licencia_carro").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "1960:2043"
          });
      });
      $(function () {
          $("#vigencia_licencia_moto").datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: "1960:2043"
          });
      });
    </script>
    <style>
      .alert {
          color: red;
      }
      .alert:before {
          content: "\26A0";
          margin-right: 5px;
      }
      .prueba{
          background-image: url("views/img/tumblr_n6d0vi7Hex1rvn6njo1_1280.gif");
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
      }
      
      #map {
        height: 400px;
        width: 100%;
      }
    </style>

    <?php if (!empty($routesArray[1]) && !isset($routesArray[3])): ?>

      <?php
      if ($routesArray[1] == 'home' ||
              $routesArray[1] == 'usuarios' ||
              $routesArray[1] == 'micuenta' ||
              $routesArray[1] == 'reportes' ||
              $routesArray[1] == 'salir'):
        ?>

        <!<!-- Datatables & Plugins -->

        <link rel="stylesheet" href="views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="views/assets/plugins/jszip/jszip.min.js"></script>
        <script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!<!-- //Datatables & Plugins -->

      <?php endif; ?>

    <?php endif; ?>

    <script src="views/assets/custom/alerts/alerts.js"></script>

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">

    <?php
    if (!isset($_SESSION['usuario'])) {
      include 'views/pages/login/login.php';
      echo '</body></head>';
      return;
    }
    ?>

    <?php if (isset($_SESSION['usuario'])): ?>

      <div class="wrapper">
        <?php
        if (!empty($routesArray[1])) {
          if ($routesArray[1] == 'wsreports') {
            if (isset($routesArray[2]) && $routesArray[2] === 'reportegps') {
              include 'views/pages/wsreports/reporte-gps.php';
              echo '</body></head>';
              return;
            }
          }
        }
        ?>
        <?php include 'views/modules/navbar.php'; ?>
        <?php include 'views/modules/sidebar.php'; ?>

        <?php
        if (!empty($routesArray[1])) {
          if ($routesArray[1] == 'home' ||
                  $routesArray[1] == 'usuarios' ||
                  $routesArray[1] == 'micuenta' ||
                  $routesArray[1] == 'reportes' ||
                  $routesArray[1] == 'mapa' ||
                  $routesArray[1] == 'salir'
          ) {
            include 'views/pages/' . $routesArray[1] . '/' . $routesArray[1] . '.php';
          } else {
            include 'views/pages/404/404.php';
          }
        } else {
          include 'views/pages/home/home.php';
        }
        ?>

        <!-- /.content-wrapper -->
        <?php include 'views/modules/footer.php'; ?>


      </div>
      <!-- ./wrapper -->

    <?php endif ?>

  </body>
</html>

