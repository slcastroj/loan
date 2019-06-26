$(function()
{
    $('#btnGrabar').click(function()
    {
        if(!$.trim($('#txtRut').val()))
        {
            alert('Falta rut');
            $('#txtRut').focus();
            return false;
        }
        if(!$('#txtNombre').val())
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return false;
        }
        if(!$('#txtPaterno').val())
        {
            alert('Falta Nombre Paterno');
            $('#txtPaterno').focus();
            return false;
        }
        if(!$('#txtMaterno').val())
        {
            alert('Falta Nombre Materno');
            $('#txtMaterno').focus();
            return false;
        }
        
    })
})

function agregarUsuario() {
    var rut = $('#txtRut').val();
    rut = rut.replace(/(\.|\-)/g, "");
    var dv = rut.slice(-1);
    rut = rut.substr(0, rut.length - 1);
    var data = {
        rut: rut,
        clave: $("#txtClave").val(),
        dv: dv,
        nombre: $("#txtNombre").val(),
        paterno: $("#txtPaterno").val(),
        materno: $("#txtMaterno").val(),
        activo: $("#pckActivo").val(),
        vendedor: $("#pckEsVendedor").val(),
        sucursal: $("#pckSucursal").val()
    };
    $.redirect('usuario.php', data, 'POST');
}

function eliminarUsuario(index) {
    $.ajax({
        type: 'DELETE',
        url: 'usuario.php?'+"index="+index,
        success: function (rs) {
            location.replace('usuario.php');
        }
    });
}