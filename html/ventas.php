<?php
use models\models\UsuarioQuery;

include_once("../vendor/autoload.php");
include_once("../generated-conf/config.php");
include_once("../php/utils.php");

validarUsuario(true);
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
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                    <option value="">13</option>
                    <option value="">14</option>
                    <option value="">15</option>
                    <option value="">16</option>
                    <option value="">17</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                </select>
                <label class="mt-2">Cantidad:</label>
                <input type="text" id="txtCantidad" class="form-control">

                <div class="mt-4 text-right d-none d-lg-block">
                    <button class="btn btn-outline-danger btn-sm col-3">Limpiar</button>
                    <button class="btn btn-primary col-4">Vender</button>
                </div>
            </div>
            <div class="col-12 col-lg-1 d-flex text-center align-items-center justify-content-center my-3 my-lg-0">
                <div class="d-none d-lg-block">
                    <div class="row">
                        <button class="col-12 btn btn-outline-primary mb-lg-3">></button>
                        <button class="col-12 btn btn-outline-danger"><</button>
                    </div>
                </div>
                <div class="d-lg-none">
                    <button class="btn btn-outline-primary mr-2">v</button>
                    <button class="btn btn-outline-danger ml-2">^</button>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <input type="search" id="txtBusquedaAgregado" class="form-control">
                <select id="pckProductoAgregado" class="form-control mt-3" size="15">
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                    <option value="">13</option>
                    <option value="">14</option>
                    <option value="">15</option>
                    <option value="">16</option>
                    <option value="">17</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                </select>
                <div class="mt-4 text-right d-lg-none">
                    <button class="btn btn-outline-danger btn-sm col-12 mb-3">Limpiar</button>
                    <button class="btn btn-primary col-12">Vender</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>