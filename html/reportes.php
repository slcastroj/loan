<?php
use models\models\UsuarioQuery;
use models\models\ProductoQuery;
use models\models\SucursalQuery;

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
                <h4>Usuarios</h4>
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
            </div>
        </div>
    </main>
</body>
</html>