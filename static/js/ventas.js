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
    var data = [];

    $('#pckProductoAgregado option').each(function() {
        data.push({
            id: $(this).val(),
            cantidad: $(this).data('cantidad')
        });
    });

    $.redirect('detalle_venta.php', data, 'POST');
}