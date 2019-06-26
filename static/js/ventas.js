function agregarProducto() {
    if(isNaN($('#txtCantidad').val()))
    {
        alert('Cantidad no es numero');
        $('#txtCantidad').focus();
        return;
    }
    if(!$.trim($('#txtCantidad').val()))
    {
        alert('Falta cantidad');
        $('#txtCantidad').focus();
        return;
    }

    var id  = $('#pckProductoAgregar').val();
    var nombre  = $('#pckProductoAgregar option:selected').text();
    var cant = $('#txtCantidad').val();

    $('#pckProductoAgregado').append(
        `<option value="${id}" data-cantidad="${cant}" data-nombre="${nombre}">
        (${cant}) ${nombre}</option>`);
}

function eliminarProducto() {
    $('#pckProductoAgregado option:selected').remove();
}

function vender() {
    var data = {};

    var vacio = true;
    $('#pckProductoAgregado option').each(function() {
        var key = $(this).val();
        var cantidad = $(this).data('cantidad');
        var nombre = $(this).data('nombre');

        if(key in data) {
            data[key].cantidad = data[key].cantidad + cantidad;
        }
        else { 
            data[key] = {
                'nombre': nombre,
                'cantidad': cantidad
            }; 
        }
        vacio = false;
    });

    if(vacio) {
        alert('Agregue productos');
        $('#pckProductoAgregado').focus();
        return;
    }

    $.redirect('detalle_venta.php', data, 'POST');
}