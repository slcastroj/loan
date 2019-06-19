function borrarCookie(nombre) {
    document.cookie = nombre + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function cerrarSesion() {
    borrarCookie('sesion');
    window.location.replace("./inicio_sesion.php");
}