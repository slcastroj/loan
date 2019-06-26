function eliminarBoleta(index) {
    $.ajax({
        type: 'DELETE',
        url: 'boleta.php?'+"index="+index,
        success: function (rs) {
            location.replace('boleta.php');
        }
    });
}