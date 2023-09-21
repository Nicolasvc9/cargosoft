<?php
session_start();
$ruta = 7;
if (!isset($_GET['id']) && !isset($_GET['guia'])) {
    header("Location: ../../");
}
$titulo = "Carta de responsabilidad";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

require_once($rutaLocal . "/models/Base.php");
require_once($rutaLocal . "/models/Product.php");
$product = new Product;
date_default_timezone_set('America/Bogota');
$fechaHoy = date("Y-m-d");

?>
<style>
    @media print {
        .divBtnImp {
            display: none;
        }
    }

    body {
        width: 215.9mm;
        height: 279.4mm;
        margin: 0 auto;
        padding: 50px;
        background-color: #fff;
    }
</style>

<body>
    <div class="divBtnImp">
        <button class="btn btn-info" id="btnImprimir">Imprimir</button>
    </div>
    <div class="" id="documento">
        <div class="fw-bold m-1 text-center">
            FORMATO CARTA DE RESPONSABILIDAD
        </div>
        <span class="text-left">
            Fecha: <?= $fechaHoy ?>
        </span><br>
        Señores: <b> POLICÍA ANTINARCOTICOS </b><br>
        Aeropuerto el Dorado Bogotá <br>
        <br>
        REF. CARTA DE RESPONSABILIDAD <br>
        Yo________________________________ identificado(a) con cedula de ciudadanía No._______________________ expedida en______________________ en mi condición de representante de la Empresa ___________________________ con NIT. ____________________________________ certifico que el contenido de la presente carga se ajusta a lo declarado en la guía aérea No. <span id="guiaNumero"></span> correspondiente a nuestro despacho.
        Así: <br>
        <br>
        Consignatario final: <span id="nombreDestinatario"></span> <br>
        Destino: <span id="ciudadDestino"></span> <br>
        Descripción de la mercancía: <span id="descripcion"></span> <br>
        Total piezas: <span id="piezas"></span><br>
        Total kilos: <span id="kilos"></span>
        <br>
        <b>NOTA:</b> CUANDO NO SE CONOZCA ALGUNO DE ESTOS DATOS DILIGENCIA LA CASILLA CON UNA (X) <br>
        Nos hacemos responsables por el contenido de esta carga ante la aerolíneas colombianas y/o extranjeras y ante el transportador aéreo en caso de que se encuentren sustancias o elementos narcóticos explosivos, ilícitos o prohibidos ( estipulados en las normas internacionales a excepción de aquellos que expresamente se han declarado como tal) armas o partes de ellas, municiones, materiales de guerra o sus partes u otros elementos que no cumplan con las obligaciones legales establecidas para este tipo de carga, siempre que se conserven en sus empaques característicos y sellos originales con las que se ha entregado al transportador aéreo. El embarque ha sido preparado en lugares con optimas condiciones de seguridad y protegido de toda intervención ilícita durante su preparación, embalaje, almacenamiento y transporte hacia las instalaciones de la aerolínea y cumplen con todos los requisitos exigidos por la ley. <br>
        <div class="row">
            <div class="col-9 p-3">Atentamente, <br>
                NOMBRE LEGIBLE _______________________________________________________________ <br>
                FIRMA Y POSFIRMA _____________________________________________________________ <br>
                C.C. ____________________________________ CARGO: __________________________ <br>
            </div>
            <div class="col-3 p-3"><img class="img-fluid" src="../../../temp_data/docs/huella_<?= $_GET['guia'] ?>.jpg" alt=""></div>
            <div class="col-4 p-3"><img class="img-fluid" src="../../../temp_data/docs/foto_<?= $_GET['guia'] ?>.png" alt=""></div>
            <div class="col-4 p-3"><img class="img-fluid" src="../../../temp_data/docs/cedula1_<?= $_GET['guia'] ?>.jpg" alt=""></div>
            <div class="col-4 p-3"><img class="img-fluid" src="../../../temp_data/docs/cedula2_<?= $_GET['guia'] ?>.jpg" alt=""></div>
        </div>
    </div>
    <?php
    require_once $rutaLocal . "/includes/scripts.php";
    ?>
    <script src="/js/functions_cartaResponsabilidad.js"></script>
</body>

</html>