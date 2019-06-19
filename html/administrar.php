<?php
use models\models\UsuarioQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");

if(!isset($_COOKIE['sesion'])) {
    header('Location: inicio_sesion.php', TRUE, 302);
}

$usuario = UsuarioQuery::create()->findOneByRut($_COOKIE['sesion']);
$esVendedor = $usuario->getEsvendedor() != 0 ? true : false;

if($esVendedor) {
    header('Location: ventas.php', TRUE, 302);
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <title>Índice</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row mt-5 m-lg-5">
            <?php include_once('../templates/cerrar_sesion.php'); ?>
            <div class="col-12 col-lg-3">
                <a href="usuario.php" class="btn btn-primary col-12 mb-3">Usuarios</a>
                <a href="producto.php" class="btn btn-primary col-12 mb-3">Productos</a>
                <a href="sucursal.php" class="btn btn-primary col-12 mb-3">Sucursales</a>
                <a href="proveedor.php" class="btn btn-primary col-12 mb-3">Proveedores</a>
                <a href="tipoProducto.php" class="btn btn-primary col-12 mb-3">Tipos de producto</a>
            </div>
        </div>
    </main>
</body>
</html>