function agregarProducto() {
    var id  = $('#pckProductoAgregar').val();
    var nombre  = $('#pckProductoAgregar option:selected').text();
    var cant = $('#txtCantidad').val() || 1;

    $('#pckProductoAgregado').append(new Option(`(${cant}) ${nombre}`, id));
}

function eliminarProducto() {
    $('#pckProductoAgregado option:selected').remove();
}