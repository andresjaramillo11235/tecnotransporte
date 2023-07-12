
$(function () {
    $("#fvencimiento").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "2000:2030"
    });
});
$(function () {
    $("#fexpedicion").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2030"
    });
});






/*=============================================
 Función para validar formulario
 =============================================*/
function validateJS(event, type) {

    var pattern;

    if (type == "number")
        pattern = /^[0-9]{1,}$/;

    if (type == "text")
        pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9\\& ]{1,}$/;

    if (type == "t&n")
        pattern = /^[A-Za-z0-9]{1,}$/;

    if (type == "email")
        pattern = /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

    if (type == "pass")
        pattern = /^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/;

    if (type == "regex")
        pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if (type == "phone")
        pattern = /^[-\\(\\)\\0-9 ]{1,}$/;

    if (!pattern.test(event.target.value)) {

        $(event.target).parent().addClass("was-validated");
        $(event.target).parent().children(".invalid-feedback").html("Field syntax error");

    }

}
