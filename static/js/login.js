$(() => {
    if($.cookie("sesion") === undefined) {
        return;
    }
    document.location.replace("ventas.php");
});

function login() {
    var rut = $('#txtRut').val();
    rut = rut.replace(/(\.|\-)/g, "");
    rut = rut.substr(0, rut.length - 1);
    var data = {
        'rut': rut,
        'contrasenya': $('#txtContrasena').val()
    };

    $.redirect('inicio_sesion.php', data, 'POST');
}