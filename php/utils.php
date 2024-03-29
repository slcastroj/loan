<?php
use models\models\UsuarioQuery;

function validarUsuario($esVend)
{
    if(!isset($_COOKIE['sesion'])) {
        header('Location: inicio_sesion.php', TRUE, 302);
    }
    
    $usuario = UsuarioQuery::create()->findOneByRut($_COOKIE['sesion']);
    $esVendedor = $usuario->getEsvendedor() != 0 ? true : false;
    
    if($esVendedor !== $esVend) {
        if($esVend) {
            header('Location: administrar.php', TRUE, 302);
        }
        else {
            header('Location: ventas.php', TRUE, 302);
        }
    }
}
?>