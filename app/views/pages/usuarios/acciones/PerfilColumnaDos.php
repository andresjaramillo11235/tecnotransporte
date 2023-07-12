<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link <?php echo isset($cargaSoporte) ? '' : 'active'?>" href="#datos" data-toggle="tab">Datos básicos personales</a></li>
                <li class="nav-item"><a class="nav-link" href="#pesv" data-toggle="tab">Datos de PESV</a></li>
                <li class="nav-item"><a class="nav-link <?php echo isset($cargaSoporte) ? 'active' : ''?>" href="#archivos" data-toggle="tab">Soportes</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                
                <!-- Pestaña datos personales------------------------------- -->
                <?php include 'datosPersonales.php'; ?>

                <!-- Pestaña datos PESV ------------------------------------ -->
                <?php include 'datosPesv.php'; ?>

                <!-- Pestaña Soportes ------------------------------------ -->
                <?php require 'soportes.php'; ?>
                
            </div>
        </div>
    </div>
</div>
