$(function()
{
    $('#btnGrabar').click(function()
    {
        if(!$.trim($('#txtNombre').val()))
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return false;
        }
        if(!$('#txtPrecio').val())
        {
            alert('Falta Precio');
            $('#txtPrecio').focus();
            return false;
        }
        if(!$('#txtStock').val())
        {
            alert('Falta Stock');
            $('#txtStock').focus();
            return false;
        }
        if($('#txtStock').val() < 0)
        {
            alert('stock no puede ser negativo');
            $('#txtStock').focus();
            return false;
        }
        if(!$('#txtStockMinimo').val())
        {
            alert('falta stock');
            $('#txtStockMinimo').focus();
            return false;
        }
        if($('#txtStockMinimo').val() < 0)
        {
            alert('stockMinimo no puede ser negativo');
            $('#txtStockMinimo').focus();
            return false;
        }
        
    })
})


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
        descripcion: $("#txtDescripcion").val()
    };
    $.redirect('producto.php', data, 'POST');
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