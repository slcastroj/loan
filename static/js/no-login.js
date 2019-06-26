$(() => {
    if($.cookie("sesion") === null) {
        document.location.replace("inicio_sesion.php");
    }
});