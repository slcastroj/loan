$(function()
{
    $('#btnGrabar').click(function()
    {
        if(!$('#txtNombre').val())
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return false;
        }
    })
})

function agregarSucursal() {
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
            location.reload(true);
        }
    });
}