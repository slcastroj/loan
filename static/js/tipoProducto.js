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

function agregarTipoProducto() {
    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.ajax({
        type: 'POST',
        url: 'tipoProducto.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
}

function eliminarTipoProducto(index) {
    $.ajax({
        type: 'DELETE',
        url: 'tipoProducto.php?'+"index="+index,
        success: function (rs) {
            location.reload(true);
        }
      });
}