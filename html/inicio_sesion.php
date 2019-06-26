<?php
use models\models\UsuarioQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");

if(isset($_COOKIE['sesion'])) {
    header('Location: ventas.php', TRUE, 302);
}
$success = true;

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST') {
    if(!isset($_POST['rut'])){
        $success = false;
    }else{

    
    $rut = $_POST['rut'];
    $usuario = UsuarioQuery::create()->findOneByRut($rut);
    if(is_null($usuario)) {
        $success = false;
    }
    else {
    if(!isset($_POST['contrasenya'])){
        $success = false;
    }
    else if($usuario->getClave() === $_POST['contrasenya']) {
        setcookie('sesion', $usuario->getRut());
        header('Location: ventas.php', TRUE, 302);
        $success = true;
    }
    }
    }
    $success = false;
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../templates/imports.php"); ?>
    <script src="../static/js/login.js"></script>
    <title>Índice</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row mt-5 m-lg-5">
            <form action="inicio_sesion.php" method="POST" class="col-12 col-lg-4 mx-auto" onload="l()">
                <?php 
                    if(!$success) {
                        echo "<div class=\"alert alert-danger mb-3\" role=\"alert\">Credenciales incorrectas</div>"; 
                    }
                ?>
                <div class="form-group">
                    <label for="txtRut">Rut usuario:</label>
                    <input type="text" id="txtRut" name="rut" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txtContrasena">Contraseña:</label>
                    <input type="password" id="txtContrasena" name="contrasenya" class="form-control">
                </div>
                <div class="form-group text-right">
                    <small><a href="" class="text-danger">¿Olvidaste tu contraseña?</a></small>
                    <button type="button" onclick="login()" class="btn btn-primary ml-3 mt-2">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>