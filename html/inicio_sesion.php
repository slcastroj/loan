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
            <form action="ventas.php" method="POST" class="col-12 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="txtRut">Rut usuario:</label>
                    <input type="text" id="txtRut" name="rut" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txtContrasena">Contraseña:</label>
                    <input type="password" id="txtContrasena" name="contraseña" class="form-control">
                </div>
                <div class="form-group text-right">
                    <small><a href="" class="text-danger">¿Olvidaste tu contraseña?</a></small>
                    <input type="submit" value="Iniciar sesión" class="btn btn-primary ml-3 mt-2">
                </div>
            </form>
        </div>
    </main>
</body>
</html>