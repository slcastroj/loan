<?php
use models\models\UsuarioQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(false);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <script src="../static/js/no-login.js"></script>
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
                <a href="marca.php" class="btn btn-primary col-12 mb-3">Marca</a>
                <a href="tipoProducto.php" class="btn btn-primary col-12 mb-3">Tipos de producto</a>
                <a href="reportes.php" class="btn btn-info col-12 mt-5">Generar reportes</a>
            </div>
        </div>
    </main>
</body>
</html>