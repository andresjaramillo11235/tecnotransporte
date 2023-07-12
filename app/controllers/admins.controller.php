
<?php

require_once "controllers/curl.controller.php";

class AdminsController {

  // Login de administradores
  public function login() {

    if (isset($_POST['loginEmail'])) {
      if ($_POST['loginEmail'] != '') {

        $url = 'usuarios?login=true&suffix=usuario';
        $method = 'POST';
        $fields = array(
            'email_usuario' => $_POST['loginEmail'] . '@correo.com',
            'password_usuario' => $_POST['loginPassword']
        );

        $response = CurlController::request($url, $method, $fields);

        if ($response->status === 200) {
          $_SESSION['usuario'] = $response->result[0];
          echo '<script>window.location = "' . $_SERVER['REQUES_URI'] . '" </script>';
        } else {
          echo '<div class="alert alert-danger">Usuario no encontrado</div>';
        }
      } else {
        echo '<div class="alert alert-warning">' . $_POST['loginEmail'] . ' Debe incluir el usuario</div>';
      }
    }
  }

  /* =========================================================================
    Creación usuarios
    ======================================================================= */

  public function create() {

    if (isset($_POST["numero_documento_usuario"])) {

      // Validar la sintaxis de los campos
      if (
              preg_match('/^[0-9]{3,}$/', $_POST["numero_documento_usuario"])
      //&&
      //preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9\\&\\. ]{1,}$/', $_POST["razon_social_usuario"]) &&
      //preg_match('/^[A-Za-z0-9 ]{2,}$/', $_POST["nombre_usuario"]) &&
      //preg_match('/^[A-Za-z0-9 ]{2,}$/', $_POST["apellido_usuario"]) &&
      //preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["correo_usuario"])
      //preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["password"]) &&
      //preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["city"]) &&
      //preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["address"]) &&
      //preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phone"]
      ) {
        if ($this->validacionTipoUsuario($_POST)) {

          // Agrupar la información
          $data = array(
              "numero_documento_usuario" => $_POST['numero_documento_usuario'],
              "tipo_usuario" => 'N',
              "razon_social_usuario" => trim(strtolower($_POST["razon_social_usuario"])),
              "nombre_usuario" => trim(strtolower($_POST["nombre_usuario"])),
              "apellido_usuario" => trim(strtolower($_POST["apellido_usuario"])),
              "correo_usuario" => trim(strtolower($_POST["correo_usuario"])),
              "email_usuario" => trim(strtolower($_POST["login"] . '@correo.com')),
              "password_usuario" => trim($_POST["pws"]),
              "fecha_creacion_usuario" => date("Y-m-d")
          );
        }

        // Solicitud a la API
        $url = "usuarios?register=true&suffix=usuario";
        $method = "POST";
        $fields = $data;

        $response = CurlController::request($url, $method, $fields);

        // Respuesta de la API
        if ($response->status == 200) {

          // Id del usuario creado
          $id = $response->result->lastId;

          echo '<script>
				fncFormatInputs();
				matPreloader("off");
				fncSweetAlert("close", "", "");
				fncSweetAlert("success", "Your records were created successfully", "/admins");
				</script>';
        }
      } else {
        echo '<script>
			fncFormatInputs();
			matPreloader("off");
			fncSweetAlert("close", "", "");
			fncNotie(3, "Field syntax error");
                    </script>';
      }
    }
  }

  private function validacionTipoUsuario($post) {

    $r = false;

    // si persona natural, debe venir el nombre
    if ($post['tipo_usuario'] == 1 && isset($post['nombre_usuario'])) {
      $r = true;
    }

    if ($post['tipo_usuario'] == 2 && isset($post['razon_social_usuario'])) {
      $r = true;
    }

    return $r;
  }

}
