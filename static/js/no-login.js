$(() => {
    if(Cookies.get("sesion") === undefined) {
        document.location.replace("inicio_sesion.php");
    }
});