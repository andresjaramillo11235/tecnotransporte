<style>
    .preview-file {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .preview-file img {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
    }

    .preview-file .file-info {
        font-size: 14px;
    }
</style>








<?php
$selectTipoDocumentoCarga = AddsController::selectTipoDocumentoCarga();
?>

<?php if (isset($confirmacion)): ?>
  <script>
    swal({title: "Exito!",
        text: "El archivo fue cargado.",
        type: "success"}).then(okay => {
        if (okay) {
            window.location.href = '/usuarios/acciones/perfil/<?php echo $_POST['idusuario']; ?>';
        }
    });
  </script>
<?php endif; ?>


<?php if (isset($errorMsg)): ?>
  <script>
    swal({title: "Error",
        text: "<?php echo $errorMsg ?>",
        type: "error"}).then(okay => {
        if (okay) {

        }
    });
  </script>


<?php endif; ?>  


<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row align-items-start">
            <div class="col">
                <label> Tipo de documento</label>
                <?php echo $selectTipoDocumentoCarga ?> 

                <label> Número</label>
                <input type="text" class="form-control" name="numero_documento" value="">  

                <label> Descripción</label>
                <input type="text" class="form-control" name="descripcion_archivo" value="">  

                <label> Fecha de expedición</label>
                <input type="text" class="form-control" id="fexpedicion" name="fecha_expedicion">

                <label> Fecha de vencimiento</label>
                <input type="text" class="form-control" id="fvencimiento" name="fecha_vencimiento">

                <input type="hidden" name="idusuario" value="<?php echo $idUsuario ?>">
                <input type="hidden" name="cargar_soporte" value=true>
            </div>
            <div class="col">

                <input type="file" id="fileInput" name="userfile" multiple>
                <div id="previewContainer"></div>

                <script>
                  function handleFileSelect(event) {
                      const files = event.target.files;
                      const previewContainer = document.getElementById("previewContainer");
                      previewContainer.innerHTML = "";

                      for (let i = 0; i < files.length; i++) {
                          const file = files[i];
                          const reader = new FileReader();

                          reader.onload = function (event) {
                              const previewFile = document.createElement("div");
                              previewFile.className = "preview-file";

                              if (file.type.includes("image")) {
                                  const image = document.createElement("img");
                                  image.src = event.target.result;
                                  previewFile.appendChild(image);
                              }

                              const fileInfo = document.createElement("p");
                              fileInfo.className = "file-info";
                              fileInfo.textContent = `${file.name} (${file.type})`;
                              previewFile.appendChild(fileInfo);

                              previewContainer.appendChild(previewFile);
                          };

                          reader.readAsDataURL(file);
                      }
                  }

                  const fileInput = document.getElementById("fileInput");
                  fileInput.addEventListener("change", handleFileSelect);
                </script>

            </div>
        </div>

        <div class="row " style="margin-top: 15px; text-align: right;">
            <button type="submit" class="btn btn-dark" name="uploadfile" value="upload">Aceptar</button>
        </div>
    </div>
</form>








