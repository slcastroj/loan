function agregarMarca() {
    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val(),
    };
    $.ajax({
        type: 'POST',
        url: 'marca.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
}

function eliminarMarca(index) {
    $.ajax({
        type: 'DELETE',
        url: 'marca.php?'+"index="+index,
        success: function (rs) {
            location.reload(true);
        }
      });
}