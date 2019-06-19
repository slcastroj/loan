function agregarProveedor() {
    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.ajax({
        type: 'POST',
        url: 'proveedor.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
}

function eliminarProveedor(index) {
    $.ajax({
        type: 'DELETE',
        url: 'proveedor.php?'+"index="+index,
        success: function (rs) {
            location.reload(true);
        }
      });
}