let myDropzone = new Dropzone('.dropzone', {
    url: '/usuarios/acciones/perfil',
    maxFilesize: 50,
    maxFiles: 3,
    acceptedFiles: 'image/jpeg, image/png, application/pdf',
    addRemoveLinks: true,
    dictRemoveFile: 'Quitar'
})

