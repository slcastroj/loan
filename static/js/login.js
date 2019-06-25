function login() {
    var data = {
        'rut': rut.substr(0, rut.length - 2).replace(/\./g, ""),
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