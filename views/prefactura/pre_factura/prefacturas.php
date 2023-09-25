<?php
session_start();
$ruta = 2;
$titulo = "Prefacturas|CargoCaribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $page = "Prefacturas";
        require_once $rutaLocal . "/includes/navbar.php";
        require_once $rutaLocal . "/includes/sidebar.php";
        ?>

        <div class="content-wrapper py-3 px-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <form action="" id="filtroGuias">
                            <div class="row border border-secondary rounded p-3">
                                <div class="col-4 form-group">
                                    <label class="w-100">
                                        Fecha Inicio
                                        <input type="date" name="" id="desde" class="form-control">
                                    </label>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="w-100">
                                        Fecha final
                                        <input type="date" name="" id="hasta" class="form-control">
                                    </label>
                                </div>
                                <div class="col-5 form-group">
                                    <label class="w-100">
                                        Ciudad
                                        <select id="select_idciudad" class="form-select">
                                            <option value="0" selected enabled>San Andres</option>
                                            <option value="1" selected enabled>Bogota</option>
                                            <option value="2" selected enabled>Medellin</option>
                                            <option value="3" selected disabled>seleccione una ciudad </option>
                                        </select>
                                        <input type="hidden" id="origen">
                                    </label>
                                    <div class="col-4 form-group mt-3">
                                        <button class="btn btn_primary" type="submit">Buscar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label">Seleccione las prefacturas</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="buscar">
                        </div>
                    </div>
                    <div class="col-12 form-group  border border-primary">
                        <div class="porc-40 overflow-y-auto">
                            <table id="tablaGuias" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>-</th>
                                        <th># Guía</th>
                                        <th>NIT</th>
                                        <th>Cliente</th>
                                        <th>Kilos</th>
                                        <th>Volumen</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-warning" role="alert">
                                                no hay guias disponibles, verifique los parametros de busqueda
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn_primary" type="submit">cambiar número</button>
                    <button class="btn btn_primary" type="submit">Eliminar Prefactura</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    require_once $rutaLocal . "/includes/scripts.php"; ?>
    <script src="/js/functions_pallet.js"></script>
</body>