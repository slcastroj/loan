<?php
include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");

use models\models\ProductoQuery;
use models\models\Base\TipoproductoQuery;
use models\models\MarcaQuery;
use models\models\ProveedorQuery;
use models\models\UsuarioQuery;
use models\models\Producto;

if(!isset($_COOKIE['sesion'])) {
    header('Location: inicio_sesion.php', TRUE, 302);
}

$usuario = UsuarioQuery::create()->findOneByRut($_COOKIE['sesion']);
$esVendedor = $usuario->getEsvendedor() != 0 ? true : false;

if($esVendedor) {
    header('Location: ventas.php', TRUE, 302);
}

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST') {
    $p = new Producto();
    $p->setNombreproducto($_POST['nombre']);
    $p->setPrecio($_POST['precio']);
    $p->setIdtipoproducto($_POST['tipo']);
    $p->setIdmarca($_POST['marca']);
    $p->setIdproveedor($_POST['proveedor']);
    $p->setActivo($_POST['activo']);
    $p->setStock($_POST['stock']);
    $p->setStockminimo($_POST['stockMinimo']);
    $p->setDescripcion($_POST['descripcion']);
    $p->save();

    header('Content-type: application/json');
    echo json_encode($p);
    die();
}
else if($method === 'DELETE') {
    $p = ProductoQuery::create()->findOneByIdproducto($_GET['index']);
    $p->delete();

    header('Content-type: application/json');
    echo json_encode($p);
    die();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <script src="../static/js/producto.js"></script>
    <title>Índice</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row mt-5 m-lg-5">
            <?php include_once('../templates/cerrar_sesion.php'); ?>
            <a href="administrar.php" class="col-12 text-secondary mb-3" style="cursor:pointer">Atrás</a>
            <form action="" class="col-12 col-lg-6">
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" name="nombre" id="txtNombre" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtPrecio">Precio:</label>
                    <input type="text" name="precio" id="txtPrecio" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckTipo">Tipo:</label>
                    <select name="tipo" id="pckTipo" class="form-control">
                        <?php
                        $tipos = TipoproductoQuery::create()->find();

                        foreach($tipos as $tipo) {
                            $id = $tipo->getIdtipoproducto();
                            $nombre = $tipo->getNombre();

                            echo "<option value=\"$id\">$nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckMarca">Marca:</label>
                    <select name="marca" id="pckMarca" class="form-control">
                        <?php
                        $marcas = MarcaQuery::create()->find();

                        foreach($marcas as $marca) {
                            $id = $marca->getIdmarca();
                            $nombre = $marca->getNombre();

                            echo "<option value=\"$id\">$nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckProveedor">Proveedor:</label>
                    <select name="proveedor" id="pckProveedor" class="form-control">
                        <?php
                        $proveedores = ProveedorQuery::create()->find();

                        foreach($proveedores as $proveedor) {
                            $id = $proveedor->getIdproveedor();
                            $nombre = $proveedor->getNombre();

                            echo "<option value=\"$id\">$nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckActivo">Activo:</label>
                    <select name="activo" id="pckActivo" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtStock">Stock:</label>
                    <input type="text" name="stock" id="txtStock" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtStockMinimo">Stock Mínimo:</label>
                    <input type="text" name="stockMinimo" id="txtStockMinimo" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="txtDescripcion">Descripcion:</label>
                    <textarea name="descripcion" id="txtDescripcion" class="form-control" rows="6" style="resize:none"></textarea>
                </div>
                <div class="text-right col-12">
                    <button class="btn btn-outline-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0">Limpiar campos</button>
                    <button type="button" class="btn btn-primary col-12 col-lg-4" onclick="agregarProducto()">Agregar</button>
                </div>
            </div>
            </form>
            <div class="col-12 col-lg-6 p-5" style="height:500px; overflow-y:scroll">
                <?php
                $productos = ProductoQuery::create()->find();

                foreach ($productos as $producto) {
                    $index = $producto->getIdproducto();
                    $nombre = $producto->getNombreproducto();
                    $precio = $producto->getPrecio();
                    $stock = $producto->getStock();
                    $stockmin = $producto->getStockminimo();
                    $activo = $producto->getActivo() != 0 ? 'Si' : 'No';
                    $proveedor = $producto->getProveedor()->getNombre();
                    $marca = $producto->getMarca()->getNombre();
                    $tipo = $producto->getTipoproducto()->getNombre();

                    echo "<div class=\"row border rounded p-2 mb-3\">
                    <span class=\"text-primary col-12\">$nombre</span>
                    <div class=\"col-12 col-lg-6\">
                        <span class=\"text-secondary\">Precio: $precio</span>
                        <br>
                        <span class=\"text-secondary\">Stock: $stock</span>
                        <br>
                        <span class=\"text-secondary\">Stock Mínimo: $stockmin</span>
                        <br>
                        <span class=\"text-secondary\">Activo: $activo</span>
                    </div>
                    <div class=\"col-12 col-lg-6 mb-3 mb-lg-0\">
                        <span class=\"text-secondary\">Proveedor: $proveedor</span>
                        <br>
                        <span class=\"text-secondary\">Marca: $marca</span>
                        <br>
                        <span class=\"text-secondary\">Tipo: $tipo</span>
                    </div>
                    <div class=\"col-12 text-right\">
                        <button class=\"btn btn-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0\" onclick=\"eliminarProducto($index)\">Eliminar</button>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>