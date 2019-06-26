<?php
use models\models\SucursalQuery;
use models\models\UsuarioQuery;
use models\models\Usuario;
use models\models\BoletaQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(false);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'DELETE') {
    $p = BoletaQuery::create()->findOneByIdboleta($_GET['index']);
    $p->delete();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <script src="../static/js/boleta.js"></script>
    <script src="../static/js/no-login.js"></script>
    <title>Índice</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row mt-5 m-lg-5">
            <?php include_once('../templates/cerrar_sesion.php'); ?>
            <a href="administrar.php" class="col-12 text-secondary mb-3" style="cursor:pointer">Atrás</a>
            <div class="col-12 p-5" style="height:500px; overflow-y:scroll">
                <?php
                $boletas = BoletaQuery::create()->find();

                foreach ($boletas as $boleta) {
                    $index = $boleta->getIdboleta();
                    $fecha = $boleta->getFecha()->format('Y-m-m');
                    $sucursal = $boleta->getSucursal()->getNombre();
                    $vendedor = $boleta->getUsuario();
                    $vendedor = $vendedor->getNombre().' '.$vendedor->getPaterno();
                    $total = $boleta->getTotal();
                    

                    echo "<div class=\"row border rounded p-2 mb-3\">
                    <span class=\"text-primary col-12\">($fecha) $index</span>
                    <div class=\"col-12 col-lg-6\">
                        <span class=\"text-secondary\">Sucursal: $sucursal</span>
                        <br>
                        <span class=\"text-secondary\">Vendedor: $vendedor</span>
                    </div>
                    <div class=\"col-12 col-lg-6\">
                        <span class=\"text-secondary\">Total: $$total</span>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>