<?php
use models\models\UsuarioQuery;
use models\models\ProductoQuery;
use models\models\SucursalQuery;
use models\models\Base\MarcaQuery;
use models\models\ProveedorQuery;
use models\models\Base\TipoproductoQuery;
use models\models\Base\BoletaQuery;
use models\models\Base\DetalleQuery;

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
            <a href="administrar.php" class="col-12 text-secondary mb-3" style="cursor:pointer">Atrás</a>
            <div class="col-12">
                
                <?php
                $usuarios = UsuarioQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Usuarios</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Rut</th>
                        <th>Digito</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Sucursal</th>
                        <th>¿Activo?</th>
                        <th>¿Vendedor?</th>
                    </thead>
                    <tbody>
                ";

                foreach ($usuarios as $key => $usuario) {
                    $id = $usuario->getIdusuario();
                    $rut = $usuario->getRut();
                    $dv = $usuario->getDigito();
                    $nombre = $usuario->getNombre();
                    $paterno = $usuario->getPaterno();
                    $materno = $usuario->getMaterno();
                    $sucursal = SucursalQuery::create()->findOneByIdsucursal($usuario->getIdsucursal())->getNombre();
                    $activo = $usuario->getActivo() > 0 ? 'Si' : 'No';
                    $vendedor = $usuario->getEsvendedor() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$rut</td>
                        <td>$dv</td>
                        <td>$nombre</td>
                        <td>$paterno</td>
                        <td>$materno</td>
                        <td>$sucursal</td>
                        <td>$activo</td>
                        <td>$vendedor</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>

                <?php
                $marcas = MarcaQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Marcas</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>¿Activo?</th>
                    </thead>
                    <tbody>
                ";

                foreach ($marcas as $key => $marca) {
                    $id = $marca->getIdmarca();
                    $nombre = $marca->getNombre();
                    $activo = $marca->getActivo() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$nombre</td>
                        <td>$activo</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>

                <?php
                $proveedores = ProveedorQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Proveedor</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>¿Activo?</th>
                    </thead>
                    <tbody>
                ";

                foreach ($proveedores as $key => $proveedor) {
                    $id = $proveedor->getIdproveedor();
                    $nombre = $proveedor->getNombre();
                    $activo = $proveedor->getActivo() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$nombre</td>
                        <td>$activo</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>

                <?php
                $sucursales = SucursalQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Sucursal</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>¿Activo?</th>
                    </thead>
                    <tbody>
                ";

                foreach ($sucursales as $key => $sucursal) {
                    $id = $sucursal->getIdsucursal();
                    $nombre = $sucursal->getNombre();
                    $activo = $sucursal->getActivo() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$nombre</td>
                        <td>$activo</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>

                <?php
                $tipos = TipoproductoQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Tipos de Producto</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>¿Activo?</th>
                    </thead>
                    <tbody>
                ";

                foreach ($tipos as $key => $tipo) {
                    $id = $tipo->getIdtipoproducto();
                    $nombre = $tipo->getNombre();
                    $activo = $tipo->getActivo() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$nombre</td>
                        <td>$activo</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>

                <?php
                $productos = ProductoQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Productos</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Nombre Marca</th>
                        <th>Nombre Proveedor</th>
                        <th>Id Producto</th>
                        <th>Nombre Producto</th>
                        <th>Codigo</th>
                        <th>Stock</th>
                        <th>Stock Minimo</th>
                        <th>Precio</th>
                        <th>Activo</th>
                    </thead>
                    <tbody>
                ";

                foreach ($productos as $key => $producto) {
                    $id = $producto->getIdproducto();
                    $marca = MarcaQuery::create()->findOneByIdmarca($producto->getIdmarca())->getNombre();
                    $proveedor = ProveedorQuery::create()->findOneByIdproveedor($producto->getIdproveedor())->getNombre();
                    $tipo = TipoproductoQuery::create()->findOneByIdtipoproducto($producto->getIdtipoproducto())->getNombre();
                    $nombre = $producto->getNombreproducto();
                    $codigo = $producto->getCodigo();
                    $stock = $producto->getStock();
                    $stockMinimo = $producto->getStockminimo();
                    $precio = $producto->getPrecio();
                    $activo = $producto->getActivo() > 0 ? 'Si' : 'No';

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$marca</td>
                        <td>$proveedor</td>
                        <td>$tipo</td>
                        <td>$nombre</td>
                        <td>$codigo</td>
                        <td>$stock</td>
                        <td>$stockMinimo</td>
                        <td>$precio</td>
                        <td>$activo</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>
                <?php
                $boletas = BoletaQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Boletas</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Sucursal</th>
                        <th>Vendedor</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                ";

                foreach ($boletas as $key => $boleta) {
                    $id = $boleta->getIdboleta();
                    $fecha = $boleta->getFecha()->format('Y-m-m');
                    $sucursal = $boleta->getSucursal()->getNombre();
                    $vendedor = $boleta->getUsuario();
                    $vendedor = $vendedor->getNombre().' '.$vendedor->getPaterno();
                    $total = $boleta->getTotal();

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$fecha</td>
                        <td>$sucursal</td>
                        <td>$vendedor</td>
                        <td>$total</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>
                <?php
                $detalles = DetalleQuery::create()->find();
                echo "
                <h4 class=\"mt-5\">Detalles boletas</h4>
                <div class=\"border rounded p-3\" style=\"overflow-x:scroll;min-height:300px;max-height:400px;\">
                <table class=\"col-12\">
                    <thead>
                        <th scope=\"col\">#</th>
                        <th>Id</th>
                        <th>Boleta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                ";

                foreach ($detalles as $key => $detalle) {
                    $id = $detalle->getIddetalle();
                    $boleta = $detalle->getIdboleta();
                    $producto = $detalle->getProducto()->getNombreproducto();
                    $cantidad = $detalle->getCantidad();
                    $precio = $detalle->getPrecio();
                    $subtotal = $detalle->getSubtotal();

                    echo "
                    <tr>
                        <th scope=\"row\">$key</th>
                        <td>$id</td>
                        <td>$boleta</td>
                        <td>$producto</td>
                        <td>$cantidad</td>
                        <td>$precio</td>
                        <td>$subtotal</td>
                    </tr>
                    ";
                }
                echo "</tbody></table></div>";
                ?>
            </div>
        </div>
    </main>
</body>
</html>