<?php
use models\models\UsuarioQuery;
use models\models\ProductoQuery;
use models\models\Sucursal;
use models\models\SucursalQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(true);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'GET') {
    header('Location: ventas.php', TRUE, 302);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <script src="../static/js/detalle_venta.js"></script>
    <title>Índice</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row m-2 m-lg-5">
            <?php include_once('../templates/cerrar_sesion.php'); ?>
            <div class="col-12">
                <?php
                $cajero = UsuarioQuery::create()->findOneByRut($_COOKIE['sesion']);
                $sucursal = SucursalQuery::create()->findOneByIdsucursal($cajero->getIdsucursal());

                $nombre_sucursal = $sucursal->getNombre();
                $fecha = date('Y-m-d');
                $nombre_vendedor = $cajero->getNombre().' '.$cajero->getPaterno().' '.$cajero->getMaterno();

                echo "
                <span><b>Vendedor:</b></span><br>
                <span class=\"muted\">$nombre_vendedor</span><br>
                <span><b>Sucursal:</b></span><br>
                <span class=\"muted\">$nombre_sucursal</span><br>
                <span><b>Fecha:</b></span><br>
                <span class=\"muted\">$fecha</span><br>
                ";
                ?>

                <div class="p-0 p-lg-3 mt-5">
                    <?php
                    $productos = $_POST;
                    $total = 0;
                    $prod_array = [
                        "sucursal" => $sucursal->getIdsucursal(),
                        "vendedor" => $cajero->getIdusuario(),
                        "fecha" => $fecha,
                        "productos" => []
                    ];

                    foreach ($productos as $id => $value) {
                        $prod = ProductoQuery::create()->findOneByIdproducto($id);

                        $nombre_producto = $prod->getNombreproducto();
                        $precio_unidad = $prod->getPrecio();
                        $cantidad = $value['cantidad'];
                        $subtotal = $cantidad * $precio_unidad;
                        $marca = $prod->getMarca()->getNombre();
                        $proveedor = $prod->getProveedor()->getNombre();
                        $tipo = $prod->getTipoproducto()->getNombre();

                        $prod_array["productos"][$id] = [
                            "cantidad" => $cantidad,
                            "subtotal" => $subtotal,
                            "producto" => $id,
                            "precio" => $precio_unidad
                        ];

                        $total = $total + $subtotal;

                        echo "
                        <div class=\"border rounded p-3 mb-3\">
                            <p class=\"text-primary\">$nombre_producto</p>
                            <div class=\"row px-3\">
                                <div class=\"col-12 col-lg-6\">
                                    <span><b>Precio unidad:</b> $$precio_unidad</span><br>
                                    <span><b>Cantidad:</b> $cantidad</span><br>
                                    <span><b>Subtotal:</b> $$subtotal</span>
                                </div>
                                <div class=\"col-12 col-lg-6\">
                                    <span><b>Marca:</b> $marca</span><br>
                                    <span><b>Proveedor:</b> $proveedor</span><br>
                                    <span><b>Tipo:</b> $tipo</span>
                                </div>
                            </div>
                        </div>";
                    }

                    echo "
                    <div class=\"text-right mt-3\">
                        <p class=\"h3 mb-3\"><b>Total:</b> $$total</p>
                        <div class=\"row justify-content-end px-3\">
                            <button class=\"btn btn-outline-danger btn-sm col-12 col-lg-1 mr-0 mr-lg-3 mb-3 mb-lg-0\">Limpiar</button>
                            <button onclick=\"vender()\" class=\"btn btn-primary col-12 col-lg-2\">Vender</button>
                        </div>
                    </div>";

                    $prod_array["total"] = $total;
                    setcookie('venta', serialize($prod_array), time()+3600);
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>