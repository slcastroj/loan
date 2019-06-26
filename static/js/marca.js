function agregarMarca() {
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
    $.redirect('marca.php', data, 'POST');
}

function eliminarMarca(index) {
    $.ajax({
        type: 'DELETE',
        url: 'marca.php?'+"index="+index,
        success: function (rs) {
            location.replace('marca.php');
        }
    });
}