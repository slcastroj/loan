function login() {
    var data = {
        'rut': $('#txtRut').val(),
        'contrasenya': $('#txtContrasena').val()
    }

    $.ajax({
        type: 'POST',
        url: 'inicio_sesion.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
        }
    });
}