<?php
$titulo = "Licad | CargoCaribe";
require_once($_SERVER['DOCUMENT_ROOT'] . '\cargasoft\includes\header.php');
require_once $_SERVER['DOCUMENT_ROOT'] . "\cargasoft\models\Base.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "\cargasoft\models\City.php";
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $page = "Licad";
        require_once ROOT . "/includes/navbar.php";
        require_once ROOT . "/includes/sidebar.php";
        ?>

        <div class="content-wrapper py-3">
            <div class="content-header w-75 mx-auto">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1 class="m-0"><?= $page ?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container w-75">
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="w-100">
                            Ruta
                            <select id="select_idruta" class="form-select">
                                <option value="">Seleccione una ruta...</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-6 form-group">
                        <label class="w-100">
                            # Licad
                            <input class="form-control" type="text" name="numLicad" id="numLicad" disabled>
                        </label>
                    </div>
                    
                    <div class="col-4 form-group">
                        Seleccione los pallets para agregarlos a este licad
                    </div>
                    <div class="col-4 form-group">
                        PesoTotal: <input type="number" value="12350" class="form-control" name="" id="" disabled >
                    </div>
                    <div class="col-4 form-group">
                        <button class="btn btn_primary" id="btnAgregarPallets">Agregar Pallets</button>
                    </div>

                    <div class="col-12 form-group">
                        <div class="">

                            <table id="listaPallets" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="" id="selectAllCheck"></th>
                                        <th># Pallet</th>
                                        <th>peso</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-12 form-group">
                        Guias incluidas para este licad
                        <div class="porc-40 overflow-y-auto">
                            <table class="table table-sm">
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once ROOT . "/includes/scripts.php"; ?>
    <script src="/cargasoft/js/functions_licad.js"></script>
</body>