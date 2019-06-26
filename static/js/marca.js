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

function agregarMarca() {
    var data = {
        nombre: $("#txtNombre").val(),
        activo: $("#pckActivo").val()
    };
    $.redirect('marca.php', data, 'POST');
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