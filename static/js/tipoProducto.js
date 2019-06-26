

function agregarTipoProducto() {
    if(!$('#txtNombre').val())
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return false;
        }

    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.redirect('tipoProducto.php', data, 'POST');
}

function eliminarTipoProducto(index) {
    $.ajax({
        type: 'DELETE',
        url: 'tipoProducto.php?'+"index="+index,
        success: function (rs) {
            location.replace('tipoProducto.php');
        }
    });
}