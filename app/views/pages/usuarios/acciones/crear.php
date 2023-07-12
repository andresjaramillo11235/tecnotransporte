<?php if (isset($isFormValid) && !$isFormValid): ?>
    <script>
        swal('Por favor corrija los valores del formulario');
    </script>
<?php endif; ?>

<?php if (isset($confirmacion)): ?>
    <script>
        swal({title: "Exito!",
            text: "El usuario fue creado.",
            type: "success"}).then(okay => {
            if (okay) {
                window.location.href = '/usuarios';
            }
        });
    </script>

<?php endif; ?>



<section class="content">

  <div class="container-fluid">

    <!-- form start -->
    <form method="post" enctype="multipart/form-data">

      <div class="row">

        <!-- left column -- -->
        <div class="col-md-6">

          <!-- general form elements -->
          <div class="card card-primary">

            <div class="card-header">
              <h3 class="card-title">Datos básicos personales - <i class="fa fa-asterisk"></i> Campos obligatorios</h3>
            </div>

            <div class="card-body">

              <!-- Número documento ------------------------------------------->
              <div class="form-group">
                <label><i class="fa fa-asterisk"></i> Número documento</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      name="ndocumento"
                      value="<?php echo isset($_POST['ndocumento']) ? $_POST['ndocumento'] : '' ?>">

                </div>

                <?php echo isset($textoErrorDocumento) ? '<p class="alert">' . $textoErrorDocumento . '</p>' : '' ?>

              </div>

              <!-- FOTO ---------------------------------------------------- -->

              <div class="input-group mb-3">

                <label>Foto</label>


                <label for="customFile" class="d-flex justify-content-center">
                  <figure class="text-center py-3">
                    <img src="views/img/users/res_defecto_hombre.png" class="img-fluid rounded-circle" style="width: 150px" id="imgPreview">
                  </figure>  

                </label>

                <div class="custom-file">
                  <input type="file" name="foto" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                </div>

              </div>

              <!-- Tipo de documento---------------------------------------- -->
              <div class="form-group">
                <label><i class="fa fa-asterisk"></i> Tipo de documento</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="tdocumento">
                    <option value="0">--Seleccionar--</option>
                    <option value="Cédula de ciudadanía" <?php echo isset($_POST['tdocumento']) && $_POST['tdocumento'] === 'Cédula de ciudadanía' ? 'selected' : '' ?>>Cédula de ciudadanía</option>
                    <option value="Cédula de extranjería" <?php echo isset($_POST['tdocumento']) && $_POST['tdocumento'] === 'Cédula de extranjería' ? 'selected' : '' ?>>Cédula de extranjería</option>
                    <option value="NIT" <?php echo isset($_POST['tdocumento']) && $_POST['tdocumento'] === 'NIT' ? 'selected' : '' ?>>NIT</option>
                  </select>
                </div>
                <?php echo isset($textoErrorTipoDocumento) ? '<p class="alert">' . $textoErrorTipoDocumento . '</p>' : '' ?>
              </div>


              <!-- Tipo de usuario -------------------------------------------->
              <div class="form-group" >
                <label><i class="fa fa-asterisk"></i> Tipo de usuario</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>

                  <select class="form-control" name="tusuario">
                    <option value="0">--Seleccionar--</option>
                    <option value="Persona natural" <?php echo isset($_POST['tusuario']) && $_POST['tusuario'] === 'Persona natural' ? 'selected' : '' ?>>Persona natural</option>
                    <option value="Persona jurídica" <?php echo isset($_POST['tusuario']) && $_POST['tusuario'] === 'Persona jurídica' ? 'selected' : '' ?>>Persona jurídica</option>
                  </select>
                </div>
                <?php echo isset($errorTipoUsuario) ? '<p class="alert">' . $errorTipoUsuario . '</p>' : '' ?>
              </div>


              <!-- Nombre usuario --------------------------------------------->
              <div class="form-group">
                <label><i class="fa fa-asterisk"></i> Nombre</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      name="nusuario" 
                      placeholder="Nombre(s)"
                      value="<?php echo isset($_POST['nusuario']) ? $_POST['nusuario'] : '' ?>">
                </div>
                <?php echo isset($errorNombre) ? '<p class="alert">' . $errorNombre . '</p>' : '' ?>
              </div>


              <!-- Apellidos usuario ------------------------------------------>
              <div class="form-group">
                <label>Apellido</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      name="ausuario" 
                      placeholder="Apellidos(s)"
                      value="<?php echo isset($_POST['ausuario']) ? $_POST['ausuario'] : '' ?>">
                </div>
                <?php echo isset($errorApellido) ? '<p class="alert">' . $errorApellido . '</p>' : '' ?>
              </div>


              <!-- Tipo de contrato ---------------------------------------------------- -->
              <div class="form-group">
                <label>Tipo de contrato</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="tcontrato">
                    <option value="0">--Seleccionar--</option>
                    <option value="Termino fijo" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Termino fijo' ? 'selected' : ''
                    ?>>Termino fijo</option>

                    <option value="Termino indefinido" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Termino indefinido' ? 'selected' : ''
                    ?>>Termino indefinido</option>

                    <option value="Obra o labor" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Obra o labor' ? 'selected' : ''
                    ?>>Obra o labor</option>

                    <option value="Contrato de aprendizaje" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Contrato de aprendizaje' ? 'selected' : ''
                    ?>>Contrato de aprendizaje</option>

                    <option value="Prestación de servicios" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Prestación de servicios' ? 'selected' : ''
                    ?>>Prestación de servicios</option>

                    <option value="Temporal, ocasional o accidental" <?php
                    echo isset($_POST['tcontrato']) && $_POST['tcontrato'] === 'Temporal, ocasional o accidental' ? 'selected' : ''
                    ?>>Temporal, ocasional o accidental</option>
                  </select>
                </div>
              </div>




              <!-- Correo electrónico ----------------------------------------->
              <div class="form-group">
                <label>Correo electrónico</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>

                  <input 
                      type="email" 
                      class="form-control" 
                      name="correo" 
                      placeholder="Correo electrónico"
                      value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : '' ?>">
                </div>
                <?php echo isset($errorCorreo) ? '<p class="alert">' . $errorCorreo . '</p>' : '' ?>
              </div>


              <!-- Contraseña ---------------------------------------------- -->
              <div class="form-group">
                <label><i class="fa fa-asterisk"></i> Contraseña</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input 
                      type="password" 
                      name="pwsuno" 
                      class="form-control" 
                      placeholder="Contraseña"
                      value="<?php echo isset($_POST['pwsuno']) ? $_POST['pwsuno'] : '' ?>">
                </div>
                <?php echo isset($errorPwsUno) ? '<p class="alert">' . $errorPwsUno . '</p>' : '' ?>
              </div>


              <!-- Confirmar Contraseña ------------------------------------ -->
              <div class="form-group">
                <label><i class="fa fa-asterisk"></i> Confirmar Contraseña</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input 
                      type="password" 
                      name="pwsdos" 
                      class="form-control" 
                      placeholder="Password"
                      value="<?php echo isset($_POST['pwsdos']) ? $_POST['pwsdos'] : '' ?>">
                </div>
                <?php echo isset($errorPwsDos) ? '<p class="alert">' . $errorPwsDos . '</p>' : '' ?>
              </div>


              <!-- Sexo ---------------------------------------------------- -->
              <div class="form-group">
                <label>Sexo</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="sexo">
                    <option value="0">--Seleccionar--</option>
                    <option value="Femenino" <?php echo isset($_POST['sexo']) && $_POST['sexo'] === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                    <option value="Masculino" <?php echo isset($_POST['sexo']) && $_POST['sexo'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                  </select>
                </div>
              </div>


              <!-- Dirección ----------------------------------------------- -->
              <div class="form-group">
                <label>Dirección</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                  </div>
                  <input type="text" 
                         class="form-control" 
                         placeholder="Dirección" 
                         name="direccion"
                         value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>">
                </div>
              </div>


              <!-- Número teléfono móvil ----------------------------------- -->
              <div class="form-group">
                <label>Número teléfono móvil</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Número teléfono móvil" 
                      name="telmovil"
                      value="<?php echo isset($_POST['telmovil']) ? $_POST['telmovil'] : '' ?>">
                </div>
              </div>


              <!-- Número teléfono fijo ------------------------------------ -->
              <div class="form-group">
                <label>Número teléfono fijo</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Número teléfono fijo" 
                      name="telfijo"
                      value="<?php echo isset($_POST['telfijo']) ? $_POST['telfijo'] : '' ?>">
                </div>
              </div>

              <!-- Fecha nacimiento ---------------------------------------- -->
              <div class="form-group">
                <label>Fecha nacimiento</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      id="datepicker" 
                      name="fnacimiento"
                      value="<?php echo isset($_POST['fnacimiento']) ? $_POST['fnacimiento'] : '' ?>">
                </div>
              </div>


              <!-- Lugar de nacimiento ------------------------------------- -->
              <div class="form-group">
                <label>Lugar de nacimiento</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Lugar de nacimiento" 
                      name="lnacimiento"
                      value="<?php echo isset($_POST['lnacimiento']) ? $_POST['lnacimiento'] : '' ?>">
                </div>
              </div>


              <!-- Estado civil -------------------------------------------- -->
              <div class="form-group">
                <label>Estado civil</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="ecivil">
                    <option value="0">--Seleccionar--</option>
                    <option value="Soltero" <?php echo isset($_POST['ecivil']) && $_POST['ecivil'] === 'Soltero' ? 'selected' : '' ?>>Soltero</option>
                    <option value="Casado" <?php echo isset($_POST['ecivil']) && $_POST['ecivil'] === 'Casado' ? 'selected' : '' ?>>Casado</option>
                    <option value="Unión libre" <?php echo isset($_POST['ecivil']) && $_POST['ecivil'] === 'Unión libre' ? 'selected' : '' ?>>Unión libre</option>
                    <option value="Viudo" <?php echo isset($_POST['ecivil']) && $_POST['ecivil'] === 'Viudo' ? 'selected' : '' ?>>Viudo</option>
                  </select>
                </div>
              </div>


              <!-- Factor RH -------------------------------------------------->
              <div class="col-md-8">
                <div class="form-group">
                  <label>Factor RH</label>
                  <div class="row">
                    <div class="col-sm">
                      <select class="form-control" name="frhuno">
                        <option value="0">--Seleccionar--</option>
                        <option value="O" <?php echo isset($_POST['frhuno']) && $_POST['frhuno'] === 'O' ? 'selected' : '' ?>>O</option>
                        <option value="A" <?php echo isset($_POST['frhuno']) && $_POST['frhuno'] === 'A' ? 'selected' : '' ?>>A</option>
                        <option value="B" <?php echo isset($_POST['frhuno']) && $_POST['frhuno'] === 'B' ? 'selected' : '' ?>>B</option>
                        <option value="AB" <?php echo isset($_POST['frhuno']) && $_POST['frhuno'] === 'AB' ? 'selected' : '' ?>>AB</option>
                      </select>
                    </div>
                    <div class="col-sm">
                      <select class="form-control" name="frhdos">
                        <option value="0">--Seleccionar--</option>
                        <option value="Positivo" <?php echo isset($_POST['frhdos']) && $_POST['frhdos'] === 'Positivo' ? 'selected' : '' ?>>Positivo</option>
                        <option value="Negativo" <?php echo isset($_POST['frhdos']) && $_POST['frhdos'] === 'Negativo' ? 'selected' : '' ?>>Negativo</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>


              <!-- EPS -------------------------------------------------------->
              <div class="form-group">
                <label>EPS</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      placeholder="EPS" 
                      name="eps"
                      value="<?php echo isset($_POST['eps']) ? $_POST['eps'] : '' ?>">
                </div>
              </div>


              <!-- Estrato Social -------------------------------------------- -->
              <div class="form-group">
                <label>Estrato social</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="esocial">
                    <option value="0">--Seleccionar--</option>
                    <option value="1" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '1' ? 'selected' : '' ?>>1</option>
                    <option value="2" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '2' ? 'selected' : '' ?>>2</option>
                    <option value="3" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '3' ? 'selected' : '' ?>>3</option>
                    <option value="4" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '4' ? 'selected' : '' ?>>4</option>
                    <option value="5" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '5' ? 'selected' : '' ?>>5</option>
                    <option value="6" <?php echo isset($_POST['esocial']) && $_POST['esocial'] === '6' ? 'selected' : '' ?>>6</option>
                  </select>
                </div>
              </div>


              <!-- ocupacion -------------------------------------------- -->
              <div class="form-group">
                <label>Ocupación</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="ocupacion">
                    <option value="0">--Seleccionar--</option>
                    <option value="Empleado" <?php echo isset($_POST['ocupacion']) && $_POST['ocupacion'] === 'Empleado' ? 'selected' : '' ?>>Empleado</option>
                    <option value="Emprendedor" <?php echo isset($_POST['ocupacion']) && $_POST['ocupacion'] === 'Emprendedor' ? 'selected' : '' ?>>Emprendedor</option>
                  </select>
                </div>
              </div>


              <!-- nivel educativo -------------------------------------------- -->
              <div class="form-group">
                <label>Nivel educativo</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="neducativo">
                    <option value="0">--Seleccionar--</option>
                    <option value="Primaria" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Primaria' ? 'selected' : '' ?>>Primaria</option>
                    <option value="Secundaria" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Secundaria' ? 'selected' : '' ?>>Secundaria</option>
                    <option value="Técnico" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Técnico' ? 'selected' : '' ?>>Técnico</option>
                    <option value="Tecnólogo" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Tecnólogo' ? 'selected' : '' ?>>Tecnólogo</option>
                    <option value="Pregrado" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Pregrado' ? 'selected' : '' ?>>Pregrado</option>
                    <option value="Postgrado" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Postgrado' ? 'selected' : '' ?>>Postgrado</option>
                    <option value="Maestría" <?php echo isset($_POST['neducativo']) && $_POST['neducativo'] === 'Maestría' ? 'selected' : '' ?>>Maestría</option>
                  </select>
                </div>
              </div>


              <!-- Discapacidad ----------------------------------------------->
              <div class="form-group">
                <label>Discapacidades</label>
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Discapacidades" 
                    name="discapacidad"
                    value="<?php echo isset($_POST['discapacidad']) ? $_POST['discapacidad'] : '' ?>">
              </div>


              <!-- Alergias --------------------------------------------------->
              <div class="form-group">
                <label>Alergias</label>
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Alergias" 
                    name="alergias"
                    value="<?php echo isset($_POST['alergias']) ? $_POST['alergias'] : '' ?>">
              </div>


              <!-- detalle de Alergias ---------------------------------------->
              <div class="form-group">
                <label>Detalle Alergias</label>
                <textarea 
                    class="form-control" 
                    rows="3" 
                    placeholder="Detalle alergias" 
                    name="dalergias"><?php echo isset($_POST['dalergias']) ? $_POST['dalergias'] : '' ?></textarea>
              </div>


              <!-- Información de contacto para emergencias ------------------->
              <div class="form-group">
                <label>Información de contacto para emergencias</label>
                <textarea 
                    class="form-control" 
                    rows="3" 
                    placeholder="Información de contacto" 
                    name="infocontacto"><?php echo isset($_POST['infocontacto']) ? $_POST['infocontacto'] : '' ?></textarea>
              </div>


              <!-- comunidades -------------------------------------------- -->
              <div class="form-group">
                <label>Comunidades</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" name="comunidades">
                    <option value="0">--Seleccionar--</option>
                    <option value="Indígena" <?php echo isset($_POST['comunidades']) && $_POST['comunidades'] === 'Indígena' ? 'selected' : '' ?>>Indígena</option>
                    <option value="LGTBI" <?php echo isset($_POST['comunidades']) && $_POST['comunidades'] === 'LGTBI' ? 'selected' : '' ?>>LGTBI</option>
                    <option value="Mestizo" <?php echo isset($_POST['comunidades']) && $_POST['comunidades'] === 'Mestizo' ? 'selected' : '' ?>>Mestizo</option>
                    <option value="Afro" <?php echo isset($_POST['comunidades']) && $_POST['comunidades'] === 'Afro' ? 'selected' : '' ?>>Afro</option>
                    <option value="No Aplica" <?php echo isset($_POST['comunidades']) && $_POST['comunidades'] === 'No Aplica' ? 'selected' : '' ?>>No Aplica</option>
                  </select>
                </div>
              </div>

              <!-- comentarios --------------------------------------------- -->
              <div class="form-group">
                <label>Comentarios</label>
                <textarea 
                    class="form-control" 
                    rows="3" 
                    placeholder="Comentarios"
                    name="comentarios"><?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : '' ?></textarea>
              </div>

              <input type="hidden" name="accion" value="crear">


            </div>
          </div>
        </div>

        <!-- right column ---------------------------------------------- -->
        <div class="col-md-6">

          <div class="card card-primary">

            <div class="card-header">
              <h3 class="card-title">Datos de PESV</h3>
            </div>

            <div class="card-body">


              <!-- Número de inscripción RUNT --------------------------------------------->
              <div class="form-group">
                <label> Número de inscripción RUNT</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      name="numero_runt" 
                      placeholder="Número de inscripción RUNT"
                      value="<?php echo isset($_POST['numero_runt']) ? $_POST['numero_runt'] : '' ?>">
                </div>
              </div>
              <!-- // Número de inscripción RUNT --------------------------------------------->


              <!-- Categoría de licencia de carro -------------------------------------------- -->
              <div class="form-group">

                <label>Categoría de licencia de carro</label>

                <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>

                  <select class="form-control" name="tipo_licencia_carro">
                    <option value="AA">--Sin licencia--</option>
                    <option value="B1" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'B1' ? 'selected' : '' ?>>B1</option>
                    <option value="B2" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'B2' ? 'selected' : '' ?>>B2</option>
                    <option value="B3" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'B3' ? 'selected' : '' ?>>B3</option>
                    <option value="C1" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'C1' ? 'selected' : '' ?>>C1</option>
                    <option value="C2" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'C2' ? 'selected' : '' ?>>C2</option>
                    <option value="C3" <?php echo isset($_POST['tipo_licencia_carro']) && $_POST['tipo_licencia_carro'] === 'C3' ? 'selected' : '' ?>>C3</option>
                  </select>

                </div>

              </div>
              <!-- // Categoría de licencia de carro -------------------------------------------- -->

              <!-- Fecha Fecha inscripción RUNT ---------------------------------------- -->
              <div class="form-group">

                 <label>Fecha inscripción RUNT</label>

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>

                    <input 
                      type="text" 
                      class="form-control" 
                      id="fecha_inscripcion_runt" 
                      name="fecha_inscripcion_runt"
                      value="<?php echo isset($_POST['fecha_inscripcion_runt']) ? $_POST['fecha_inscripcion_runt'] : '' ?>">

                  </div>

              </div>
              <!-- // Fecha inscripción RUNT ---------------------------------------- -->

              <!-- Vigencia licencia de carro ---------------------------------------- -->
              <div class="form-group">

                 <label>Vigencia licencia de carro</label>

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>

                    <input 
                      type="text" 
                      class="form-control" 
                      id="vigencia_licencia_carro" 
                      name="vigencia_licencia_carro"
                      value="<?php echo isset($_POST['vigencia_licencia_carro']) ? $_POST['vigencia_licencia_carro'] : '' ?>">

                  </div>

              </div>
              <!-- // Vigencia licencia de carro ---------------------------------------- -->

              <!-- Categoría de licencia de moto -------------------------------------------- -->
              <div class="form-group">

                <label>Categoría de licencia de moto</label>

                <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>

                  <select class="form-control" name="tipo_licencia_moto">
                    <option value="AA">--Sin licencia--</option>
                    <option value="A1" <?php echo isset($_POST['tipo_licencia_moto']) && $_POST['tipo_licencia_moto'] === 'B1' ? 'selected' : '' ?>>A1</option>
                    <option value="A2" <?php echo isset($_POST['tipo_licencia_moto']) && $_POST['tipo_licencia_moto'] === 'B2' ? 'selected' : '' ?>>A2</option>
                  </select>

                </div>

              </div>
              <!-- // Categoría de licencia de moto -------------------------------------------- -->

              <!-- Vigencia licencia de moto ---------------------------------------- -->
              <div class="form-group">

                 <label>Vigencia licencia de moto</label>

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>

                    <input 
                      type="text" 
                      class="form-control" 
                      id="vigencia_licencia_moto" 
                      name="vigencia_licencia_moto"
                      value="<?php echo isset($_POST['vigencia_licencia_moto']) ? $_POST['vigencia_licencia_moto'] : '' ?>">

                  </div>

              </div>
              <!-- // Vigencia licencia de moto ---------------------------------------- -->

              <!-- Años de experiencia en conducción --------------------------------------------->
              <div class="form-group">
                <label> Años de experiencia en conducción</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                  </div>
                  <input 
                      type="text" 
                      class="form-control" 
                      name="anios_experiencia" 
                      placeholder="Número años de experiencia en conducción"
                      value="<?php echo isset($_POST['anios_experiencia']) ? $_POST['anios_experiencia'] : '' ?>">
                </div>
              </div>
              <!-- Años de experiencia en conducción --------------------------------------------->

              <!-- rol --------------------------------------------------------------------------->
              <?php echo AddsController::selectRoles() ?>
              <!-- //rol --------------------------------------------------------------------------->

            </div>
          </div>
        </div>
        <!--/.col (right) -->

      </div>
      <div class="card card-dark">
        <div class="card-footer">
          <div class="col-md-8 offset-md-2">
            <div class="form-group mt-5">
              <button type="submit" class="btn bg-dark float-right">Guardar</button>
              <a href="/usuarios" class="btn btn-light border text-left" >Cancelar</a> 
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
    function previewImage(event, querySelector) {

        //Recuperamos el input que desencadeno la acción
        const input = event.target;

        //Recuperamos la etiqueta img donde cargaremos la imagen
        $imgPreview = document.querySelector(querySelector);

        // Verificamos si existe una imagen seleccionada
        if (!input.files.length)
            return

        //Recuperamos el archivo subido
        file = input.files[0];

        //Creamos la url
        objectURL = URL.createObjectURL(file);

        //Modificamos el atributo src de la etiqueta img
        $imgPreview.src = objectURL;

    }
</script>












