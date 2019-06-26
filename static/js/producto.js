
function agregarProducto() {
    if(!$.trim($('#txtNombre').val()))
    {
        alert('Falta Nombre');
        $('#txtNombre').focus();
        return;
    }
    if(isNaN($('#txtCodigo').val()))
    {
        alert('Codigo no es numero');
        $('#txtCodigo').focus();
        return;
    }
    if(!$.trim($('#txtCodigo').val()))
    {
        alert('Falta codigo');
        $('#txtCodigo').focus();
        return;
    }
    if(isNaN($('#txtPrecio').val()))
    {
        alert('Precio no es numero');
        $('#txtPrecio').focus();
        return;
    }
    if(!$.trim($('#txtPrecio').val()))
    {
        alert('Falta Precio');
        $('#txtPrecio').focus();
        return;
    }
    if(isNaN($('#txtStock').val()))
    {
        alert('Stock no es numero');
        $('#txtStock').focus();
        return;
    }
    if(!$.trim($('#txtStock').val()))
    {
        alert('Falta Stock');
        $('#txtStock').focus();
        return;
    }
    if($('#txtStock').val() < 0)
    {
        alert('stock no puede ser negativo');
        $('#txtStock').focus();
        return;
    }
    if(isNaN($('#txtStockMinimo').val()))
    {
        alert('Stock minimo no es numero');
        $('#txtStockMinimo').focus();
        return;
    }
    if(!$.trim($('#txtStockMinimo').val()))
    {
        alert('falta stock');
        $('#txtStockMinimo').focus();
        return;
    }
    if($('#txtStockMinimo').val() < 0)
    {
        alert('stockMinimo no puede ser negativo');
        $('#txtStockMinimo').focus();
        return;
    }

    var stock = $('#txtStock').val();
    var stockmin = $('#txtStockMinimo').val()
    if(stock <= stockmin - 1)
    {
        alert('Stock minimo no puede ser mayor a stock');
        $('#txtStockMinimo').focus();
        return;
    }

    var data = {
        nombre: $("#txtNombre").val(),
        codigo: $("#txtCodigo").val(),
        precio: $("#txtPrecio").val(),
        tipo: $("#pckTipo").val(),
        marca: $("#pckMarca").val(),
        proveedor: $("#pckProveedor").val(),
        activo: $("#pckActivo").val(),
        stock: $("#txtStock").val(),
        stockMinimo: $("#txtStockMinimo").val()
    };
    $.redirect('producto.php', data, 'POST');
}

function eliminarProducto(index) {
    $.ajax({
        type: 'DELETE',
        url: 'producto.php?'+"index="+index,
        success: function (rs) {
            location.replace('producto.php');
        }
    });
}