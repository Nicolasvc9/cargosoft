<?php
if (!isset($_GET['licad'])) {
    header("location:index.php");
}

$titulo = "Licad | CargoCaribe";
require_once($_SERVER['DOCUMENT_ROOT'] . '\cargasoft\includes\header.php');
?>

<body>
    <div class="coontainer table">
        <table id="listaLicad">
            <thead class="bg_primary text_primary">
                <tr>
                    <th># guia</th>
                    <th>peso guia</th>
                    <th>peso licad</th>
                    <th>fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    require_once ROOT . "/includes/scripts.php"; ?>

    <script src="/cargasoft/js/functions_detalladoLicad.js"></script>
</body>