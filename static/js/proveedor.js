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

function agregarProveedor() {
    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.redirect('proveedor.php', data, 'POST');
}

function eliminarProveedor(index) {
    $.ajax({
        type: 'DELETE',
        url: 'proveedor.php?'+"index="+index,
        success: function (rs) {
            location.replace('proveedor.php');
        }
    });
}