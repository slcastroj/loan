function agregarProducto() {
    var data = {
        nombre: $("#txtNombre").val(),
        precio: $("#txtPrecio").val(),
        tipo: $("#pckTipo").val(),
        marca: $("#pckMarca").val(),
        proveedor: $("#pckProveedor").val(),
        activo: $("#pckActivo").val(),
        stock: $("#txtStock").val(),
        stockMinimo: $("#txtStockMinimo").val(),
        descripcion: $("#txtDescripcion").val(),
    };
    $.ajax({
        type: 'POST',
        url: 'producto.php',
        data: data,
        contentType: 'application/x-www-form-urlencoded',
        success: function (rs) {
            location.reload(true);
        }
      });
}

function eliminarProducto(index) {
    $.ajax({
        type: 'DELETE',
        url: 'producto.php?'+"index="+index,
        success: function (rs) {
            location.reload(true);
        }
      });
}