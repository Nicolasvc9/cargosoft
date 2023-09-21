<?php
session_start();
$ruta = 2;
$titulo = "prefactura";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $page = "Prefactura";
        require_once $rutaLocal . "/includes/navbar.php";
        require_once $rutaLocal . "/includes/sidebar.php";
        ?>

        <div class="content-wrapper py-3 px-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <form action="" id="filtroGuias">
                            <div class="row border border-secondary rounded p-3">
                                <div class="col-6 form-group">
                                    <label class="w-100">
                                        Ruta
                                        <select id="select_ruta" class="form-select">
                                            <option value="" selected disabled>Seleccione una ruta...</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="w-100">
                                        Tipo de Envio
                                        <select id="select_tipoenvio" class="form-select">
                                            <option value="" selected disabled>Seleccione un tipo de envio</option>
                                            <option value="1">Comercial</option>
                                            <option value="0">Carguero</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="w-100">
                                        Fecha inicio
                                        <input type="date" name="" id="desde" class="form-control">
                                    </label>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="w-100">
                                        Fecha final
                                        <input type="date" name="" id="hasta" class="form-control">
                                    </label>
                                </div>
                                <div class="col-4 form-group mt-3">
                                    <button class="btn btn_primary" type="submit">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12 form-group  border border-primary">

                        selecciones las guias sin prefacturar
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
                            <div class="col-4 form-group mt-3">
                                <button class="btn btn_primary" type="submit">prefacturar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    require_once $rutaLocal . "/includes/scripts.php"; ?>
    <script src="/js/functions_pallet.js"></script>
</body>