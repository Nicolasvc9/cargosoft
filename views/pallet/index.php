<?php
session_start();
$ruta = 10;
$titulo = "Licad | CargoCaribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $page = "Licad";
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
                    <div class="col-12 col-md-4">
                        <div class="row p-3 ">
                            <div class="col-8 mx-auto form-group">
                                <label class="w-100">
                                    Fecha actual
                                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="w-100">
                            Pallet
                            <select id="select_pallet" class="form-select">
                                <option value="0" selected disabled>Seleccione un pallet</option>
                                <option value="1">Pallet 1</option>
                                <option value="2">Pallet 2</option>
                                <option value="3">Pallet 3</option>
                                <option value="4">Pallet 4</option>
                                <option value="5">Pallet 5</option>
                                <option value="6">Pallet 6</option>
                                <option value="7">Pallet 7</option>
                                <option value="8">Pallet 8</option>
                                <option value="9">Pallet 9</option>
                                <option value="10">Pallet 10</option>
                                <option value="11">Pallet 11</option>
                                <option value="12">Pallet 12</option>
                                <option value="13">Latam</option>
                                <option value="14">Deprisa</option>
                                <option value="15">Copa</option>
                                <option value="16">Cac</option>
                                <option value="17">Otro</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-6 form-group p-4">
                        <button class="btn btn_primary" id="btnAsignarPallet">Asignar Pallet</button>
                    </div>
                    <div class="col-12 form-group  border border-primary">

                        selecciones las guias que desea incluir en el pallet
                        <div class="porc-40 overflow-y-auto">

                            <table id="tablaGuias" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>-</th>
                                        <th># Guía</th>
                                        <th>Kilos Guía</th>
                                        <th>Kilos Licad</th>
                                        <th>Remitente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-warning" role="alert">
                                                no hay guias disponibles, verifique los parametros de busqueda
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-6 form-group">
                        <label class="w-100">
                            listar guias para este pallet
                            <select id="select_palletListar" class="form-select">
                                <option value="0" selected disabled>Seleccione un pallet</option>
                                <option value="1">Pallet 1</option>
                                <option value="2">Pallet 2</option>
                                <option value="3">Pallet 3</option>
                                <option value="4">Pallet 4</option>
                                <option value="5">Pallet 5</option>
                                <option value="6">Pallet 6</option>
                                <option value="7">Pallet 7</option>
                                <option value="8">Pallet 8</option>
                                <option value="9">Pallet 9</option>
                                <option value="10">Pallet 10</option>
                                <option value="11">Pallet 11</option>
                                <option value="12">Pallet 12</option>
                                <option value="13">Latam</option>
                                <option value="14">Deprisa</option>
                                <option value="15">Copa</option>
                                <option value="16">Cac</option>
                                <option value="17">Otro</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-6 form-group p-4">
                        <button class="btn btn_primary" id="btnListarGuiasPallet">Listar</button>
                    </div>
                    <div class="col-12 form-group">
                        Guias incluidas para este licad
                        <div class="porc-40 overflow-y-auto">
                            <table id="tablaGuiasListar" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th># Guía</th>
                                        <th>Kilos Guía</th>
                                        <th>Kilos Licad</th>
                                        <th>Remitente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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