function agregarProducto() {
    var id  = $('#pckProductoAgregar').val();
    var nombre  = $('#pckProductoAgregar option:selected').text();
    var cant = $('#txtCantidad').val() || 1;

    $('#pckProductoAgregado').append(
        `<option value="${id}" data-cantidad="${cant}" data-nombre="${nombre}">
        (${cant}) ${nombre}</option>`);
}

function eliminarProducto() {
    $('#pckProductoAgregado option:selected').remove();
}

function vender() {
    var data = {};

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
    });

    $.redirect('detalle_venta.php', data, 'POST');
}