<?php
use models\models\UsuarioQuery;
use models\models\ProductoQuery;
use models\models\Producto;
use models\models\Boleta;
use models\models\Detalle;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(true);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST') {
    $data = unserialize($_COOKIE['venta']);
    
    $boleta = new Boleta();
    $boleta->setFecha($data['fecha']);
    $boleta->setIdsucursal($data['sucursal']);
    $boleta->setIdusuario($data['vendedor']);
    $boleta->setTotal($data['total']);
    $boleta->save();

    foreach ($data['productos'] as $key => $prod) {
        $cantidad = $prod['cantidad'];
        $subtotal = $prod['subtotal'];
        $producto = $prod['producto'];
        $precio = $prod['precio'];

        $detalle = new Detalle();
        $detalle->setCantidad($cantidad);
        $detalle->setIdboleta($boleta->getIdboleta());
        $detalle->setIdproducto($producto);
        $detalle->setSubtotal($subtotal);
        $detalle->setPrecio($precio);
        $detalle->save();
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <title>Índice</title>
    <script src="../static/js/ventas.js"></script>
</head>
<body>
    <main class="container-fluid">
        <div class="row m-2 m-lg-5">
            <?php include_once('../templates/cerrar_sesion.php'); ?>
            <div class="col-12 col-lg-3">
                <input type="search" id="txtBusquedaAgregar" class="form-control">
                <select id="pckProductoAgregar" class="form-control mt-3" size="15">
                    <?php
                    $productos = ProductoQuery::create()->find();

                    foreach($productos as $producto) {
                        $id = $producto->getIdproducto();
                        $nombre = $producto->getNombreproducto();
                        echo "<option value=\"$id\">$nombre</option>";
                    }
                    ?>
                </select>
                <label class="mt-2">Cantidad:</label>
                <input type="text" id="txtCantidad" class="form-control">

                <div class="mt-4 text-right d-none d-lg-block">
                    <button class="btn btn-outline-danger btn-sm col-4">Limpiar</button>
                    <button onclick="vender()" class="btn btn-primary col-5">Vender</button>
                </div>
            </div>
            <div class="col-12 col-lg-1 d-flex text-center align-items-center justify-content-center my-3 my-lg-0">
                <div class="d-none d-lg-block">
                    <div class="row">
                        <button onclick="agregarProducto()" class="col-12 btn btn-outline-primary mb-lg-3">></button>
                        <button onclick="eliminarProducto()" class="col-12 btn btn-outline-danger"><</button>
                    </div>
                </div>
                <div class="d-lg-none">
                    <button onclick="agregarProducto()" class="btn btn-outline-primary mr-2">v</button>
                    <button onclick="eliminarProducto()" class="btn btn-outline-danger ml-2">^</button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <input type="search" id="txtBusquedaAgregado" class="form-control">
                <select id="pckProductoAgregado" class="form-control mt-3" size="15">
                </select>
                <div class="mt-4 text-right d-lg-none">
                    <button class="btn btn-outline-danger btn-sm col-12 mb-3">Limpiar</button>
                    <button onclick="vender()" class="btn btn-primary col-12">Vender</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>