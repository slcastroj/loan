<?php
use models\models\UsuarioQuery;
use models\models\ProductoQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(true);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'GET') {
    header('Location: ventas.php', TRUE, 302);
}

echo $_POST[0]['id'];
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
        </div>
    </main>
</body>
</html>