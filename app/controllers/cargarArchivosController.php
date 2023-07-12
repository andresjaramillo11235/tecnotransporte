<?php

include_once 'controllers/CurlTraccarController.php';

print_r($_POST);
print_r($_FILES);

// Valida la carga del archivo
if (isset($_POST['uploadfile']) && $_POST['uploadfile'] == 'upload') {

  // Valida que la carga del archivo se llevo correctamente
  if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] === 0) {

    $fileTmpPath = $_FILES['userfile']['tmp_name'];
    $fileName = $_FILES['userfile']['name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // Verificar si el archivo tiene una extension permitida
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'pdf');
    

    if (in_array($fileExtension, $allowedfileExtensions)) {

      // directorio en el que se guarda el archivo
      $uploadFileDir = 'views/files/';
      $destPath = $uploadFileDir . $newFileName;

      if (move_uploaded_file($fileTmpPath, $destPath)) {

        // Carga los datos en la DB
        $data = array(
            'id_usuario' => $_POST['idusuario'],
            'tipo_documento' => $_POST['tipo_documento_carga'],
            'numero_documento' => $_POST['numero_documento'],
            'descripcion_archivo' => $_POST['descripcion_archivo'],
            'fecha_expedicion' => $_POST['fecha_expedicion'],
            'fecha_vencimiento' => $_POST['fecha_vencimiento'],
            'nombre_archivo' => $newFileName,
            'fecha_cargue' => $fecha_actual = date("Y-m-d h:i:s")
        );

        // Solicitud a la API
        $url = 'usuarios_archivos';
        $method = 'POST';
        $fields = $data;

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {
          $confirmacion = true;
        }
      } else {
        // error
      }
    } else {
      $errorMsg = 'No se admiten archivos de tipo ' . $fileExtension;
    }
  } else {
    $errorMsg = 'Debe cargar un archivo';
  }
}








