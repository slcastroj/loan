
function agregarSucursal() {
    if(!$('#txtNombre').val())
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return;
        }

    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.redirect('sucursal.php', data, 'POST');
}

function eliminarSucursal(index) {
    $.ajax({
        type: 'DELETE',
        url: 'sucursal.php?'+"index="+index,
        success: function (rs) {
            location.replace('sucursal.php');
        }
    });
}