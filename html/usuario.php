<?php
include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");

use models\models\SucursalQuery;
use models\models\UsuarioQuery;

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
            <form action="" class="col-12 col-lg-6">
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <label for="txtRut">Rut:</label>
                    <input type="text" name="rut" id="txtRut" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" name="nombre" id="txtNombre" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtPaterno">Paterno:</label>
                    <input type="text" name="paterno" id="txtPaterno" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="txtMaterno">Materno:</label>
                    <input type="text" name="materno" id="txtMaterno" class="form-control">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckActivo">Activo:</label>
                    <select name="activo" id="pckActivo" class="form-control">
                        <option value="">Si</option>
                        <option value="">No</option>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckEsVendedor">EsVendedor:</label>
                    <select name="esVendedor" id="pckEsVendedor" class="form-control">
                        <option value="">Si</option>
                        <option value="">No</option>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="pckIdSucursal">IdSucursal:</label>
                    <select name="IdSucursal" id="pckIdSucursal" class="form-control">
                        <?php
                        $tipos = SucursalQuery::create()->find();

                        foreach($tipos as $tipo) {
                            $id = $tipo->getIdsucursal();
                            $nombre = $tipo->getNombre();

                            echo "<option value=\"$id\">$nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="text-right col-12">
                    <button class="btn btn-outline-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0">Limpiar campos</button>
                    <input type="submit" class="btn btn-primary col-12 col-lg-4" value="Agregar">
                </div>
            </div>
            </form>
            <div class="col-12 col-lg-6 p-5" style="height:500px; overflow-y:scroll">
                <?php
                $usuarios = UsuarioQuery::create()->find();

                foreach ($usuarios as $usuario) {
                    $nombre = $usuario->getNombre();
                    $rut = $usuario->getRut();
                    $dv = $usuario->getDigito();
                    $paterno = $usuario->getPaterno();
                    $materno = $usuario->getMaterno();
                    $activo = $usuario->getActivo() != 0 ? 'Si' : 'No';
                    $sucursal = SucursalQuery::create()->findOneByIdsucursal($usuario->getIdsucursal())->getNombre();
                    $esVendedor = $usuario->getEsvendedor()!= 0 ? 'Si' : 'No';
                    

                    echo "<div class=\"row border rounded p-2 mb-3\">
                    <span class=\"text-primary col-12\">$nombre $paterno $materno - $rut-$dv</span>
                    <div class=\"col-12 col-lg-6\">
                        <span class=\"text-secondary\">Activo: $activo</span>
                        <br>
                        <span class=\"text-secondary\">Vendedor: $esVendedor</span>
                    </div>
                    <div class=\"col-12 col-lg-6\">
                        <span class=\"text-secondary\">Sucursal: $sucursal</span>
                    </div>
                    <div class=\"col-12 text-right\">
                        <button class=\"btn btn-danger col-12 col-lg-4 btn-sm mb-3 mb-lg-0\">Eliminar</button>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>