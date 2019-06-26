$(() => {
    if($.cookie("sesion") === undefined) {
        document.location.replace("inicio_sesion.php");
    }
});