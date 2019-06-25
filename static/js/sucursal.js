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
    $.ajax({
        type: 'POST',
        url: 'sucursal.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
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