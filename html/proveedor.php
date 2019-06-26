<?php
use models\models\ProveedorQuery;
use models\models\Proveedor;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(false);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST') {
    $p = new Proveedor();
    $p->setNombre($_POST['nombre']);
    $p->setActivo($_POST['activo']);
    $p->save();

    header('Content-type: application/json');
    echo json_encode($p);
    die();
}
else if($method === 'DELETE') {
    $p = ProveedorQuery::create()->findOneByIdproveedor($_GET['index']);
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
    <title>Índice</title>
    <script src="../static/js/proveedor.js"></script>
    <script src="../static/js/no-login.js"></script>
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
                    <label for="pckActivo">Activo:</label>
                    <select name="activo" id="pckActivo" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="text-right col-12">
                    <button class="btn btn-outline-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0">Limpiar campos</button>
                    <input onclick="agregarProveedor()" type="button" class="btn btn-primary col-12 col-lg-4" value="Agregar" id="btnGrabar">
                </div>
            </div>
            </form>
            <div class="col-12 col-lg-6 p-5" style="height:500px; overflow-y:scroll">
                <?php
                $proveedores = ProveedorQuery::create()->find();

                foreach ($proveedores as $proveedor) {
                    $index = $proveedor->getIdproveedor();
                    $nombre = $proveedor->getNombre();
                    $activo = $proveedor->getActivo() != 0 ? 'Si' : 'No';                    

                    echo "<div class=\"row border rounded p-2 mb-3\">
                    <span class=\"text-primary col-12\">$nombre</span>
                    <div class=\"col-12\">
                        <span class=\"text-secondary\">Activo: $activo</span>
                        </div>
                    <div class=\"col-12 text-right\">
                        <button onclick=\"eliminarProveedor($index)\" class=\"btn btn-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0\">Eliminar</button>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>