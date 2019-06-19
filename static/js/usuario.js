function agregarUsuario() {
    var rut = $("#txtRut").val();
    var data = {
        rut: rut.substr(0, rut.length - 2),
        dv: rut.substr(rut.length - 1, 1),
        nombre: $("#txtNombre").val(),
        paterno: $("#txtPaterno").val(),
        materno: $("#txtMaterno").val(),
        activo: $("#pckActivo").val(),
        vendedor: $("#pckEsVendedor").val(),
        sucursal: $("#pckSucursal").val()
    };
    $.ajax({
        type: 'POST',
        url: 'usuario.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
}

function eliminarUsuario(index) {
    $.ajax({
        type: 'DELETE',
        url: 'usuario.php?'+"index="+index,
        success: function (rs) {
            location.reload(true);
        }
      });
}