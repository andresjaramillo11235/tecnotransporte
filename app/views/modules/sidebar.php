<aside class="main-sidebar sidebar-dark-gray elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link navbar-warning">
        <img src="views/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TecnoTransporte</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="views/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['usuario']->nombre_usuario ?> <?php echo $_SESSION['usuario']->apellido_usuario ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/home" class="nav-link <?php if ($routesArray[1] == 'home'): ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Usuarios
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/usuarios" class="nav-link <?php if ($routesArray[1] == 'usuarios'): ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/usuarios/acciones/listar" class="nav-link <?php if ($routesArray[3] == 'listar'): ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listado</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/micuenta" class="nav-link <?php if ($routesArray[1] == 'micuenta'): ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Mi cuenta
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/mapa" class="nav-link <?php if ($routesArray[1] == 'mapa'): ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-map"></i>
                        <p>
                            Mapa
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reportes GPS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/reportes/gps" class="nav-link <?php echo $routesArray[1] == 'reportes' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportes GPS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/reporte/" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Puntos de verificación</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/e-commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top kilometrajes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/projects.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Últimas posiciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-add.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Instalaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-edit.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Uso de rastreo</p>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>