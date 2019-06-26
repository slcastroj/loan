function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    return true;
}

function agregarUsuario() {
    if(!$.trim($('#txtRut').val()))
        {
            alert('Falta rut');
            $('#txtRut').focus();
            return false;
        }
        if(!checkRut($.trim($('#txtRut').val())))
        {
            alert('Rut invalido');
            $('#txtRut').focus();
            return false;
        }
        if(!$.trim($('#txtNombre').val()))
        {
            alert('Falta Nombre');
            $('#txtNombre').focus();
            return false;
        }
        if(!$.trim($('#txtPaterno').val()))
        {
            alert('Falta Nombre Paterno');
            $('#txtPaterno').focus();
            return false;
        }
        if(!$.trim($('#txtMaterno').val()))
        {
            alert('Falta Nombre Materno');
            $('#txtMaterno').focus();
            return false;
        }

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