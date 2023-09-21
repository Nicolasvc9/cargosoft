<?php
session_start();
$ruta = 7;
$titulo = "Guías | CargoCaribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style>
    body {
        background-color: 000;
    }
    hr{
        margin: 0px 0;
        width: 100%;
        color: #000;
    }
    .letrapeque {
        font-size: 7px;
        line-height: 1;
        letter-spacing: -0.15px;
    }
    .imgLogo {
        width: 40%;
    }
    .espaiadoPeque{
        line-height: 1;
        margin: 0;
        text-align: center;
    }
    .aviso1{
        font-size: 25px;
        line-height: 1;
        font-weight: bold;
        margin: 2px;
        text-align: center;
    }
    .aviso2{
        text-align: center;
        line-height: 1;
        margin: 3px;
    }
    .Detallado{
        height: 133px;
    }
</style>

<body class="p-3">
    <div class="">
        <div class="row mx-3 mt-3">
            <div class="col-6  text-center">
                <img src="../../../assets/img/logo.png" class="imgLogo" alt="">
                <p class="letrapeque">BOG: Av. el Dorado No. 103-09 Edificio CISA - Bodega No.2 PBX: 601 316 24 25 Cel. 311 200 62 14 - asistente.administrativo@caribecargo.co <br>
                    ADZ: Aeropuerto Gustavo Rojas Pinilla Zona de carga Calle 8 No. 12-189 Tel. 608 512 09 63 Cel. 301 786 96 06 - bodegasanandres@caribecargo.co <br>
                    BAQ: Aeropuerto Ernesto Cortissoz Zona de carga Bodega Colombian Air Cargo Tel. 605 382 77 39 Cel. 323 229 67 52 - basebaq@caribecargo.co <br>
                    MDE: Carrera 45 No 27-17 Barrio Colombia Cel. 313 365 24 07 - basemde@caribecargo.co <br>
                    RNG: Aeropuerto José Maria Córdova Zona de carga Bodega Colombian Air Cargo - Girag Cel. 320 855 76 57 - baserg@canbecargo.co <br>
                    CLO: Aeropuerto Alfonso Bonilla Aragón Zona de carga Bodega 6 Colombian Air Cargo Tel. 602 666 33 64/65 Cel. 313 333 8031- asistente.administrativo@caribecargo.co</p>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-4 p-2 small">
                        <div class="text-center rounded border border-dark">
                            <div class="border-bottom border-dark fw-bold">Origen</div>
                            <span id="origen"></span>
                        </div>
                    </div>
                    <div class="col-4 p-2 small">
                        <div class="text-center rounded border border-dark">
                            <div class="border-bottom border-dark fw-bold">Destino</div>
                            <div id="destino"></div>
                        </div>
                    </div>
                    <div class="col-4 small">
                        <div class="fw-bold small">GUIA</div>
                        <div class="h2" id="numGuia"></div>
                    </div>
                    <div class="col-4 p-2 small">
                        <div class="text-center rounded border border-dark">
                            <div class="border-bottom border-dark fw-bold">Dia | Mes | Año</div>
                            <div id="fecha"></div>
                        </div>
                    </div>
                    <div class="col-8 p-2 small">
                        <div class="text-center rounded border border-dark">
                            <div class="border-bottom border-dark fw-bold">Forma de pago</div>
                            <div id="formapago"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 p-2 ">
                <div class="border border-dark rounded overflow-hidden">
                    <div class="border-bottom border-dark text-center fw-bold small">DESTINATARIO</div>
                    <p class="espaiadoPeque">
                        <span id="destinatario"></span>
                        </p>
                    <div class="row small">
                        <div class="col-3 border border-dark">
                            <span class="fw-bold">Piezas:</span> <span id="piezas"></span>
                        </div>
                        <div class="col-3 border border-dark">
                            <span class="fw-bold">Peso kg:</span> <span id="kg"></span>
                        </div>
                        <div class="col-3 border border-dark">
                            <span class="fw-bold">Volumen:</span> <span id="vol"> </span>
                        </div>
                        <div class="col-3 border border-dark">
                            <span class="fw-bold">Tarifa: $</span> <span id="tarifa"></span>
                        </div>
                        <div class="col-12 Detallado">
                            <div class="small">Dice contener:</div>
                            <div class="mx-5" id="detalle">CORREO, Viaja embalaje bajo responsabilidad del cLiente/Carga sujeta a Cupo // 13 TELEVISORES Y 8 PIEZAS CARGA GENERAL - Paga: Remitente T.R.Combustibe: $538.500</div>
                        </div>
                        <div class="col-12 border border-dark">
                            <p class="aviso1">
                                NO SE RESPONDE POR VIDRIO <br> MERCANCÍA SIN VERIFICAR CONTENIDO
                            </p>
                        </div>
                        <div class="col-12 border border-dark">
                            <p class="aviso2">
                                El remitente al hacer este envío acepta implicitamente la tarifa aplicada <br> y las condiciones de transporte impresas al respaldo de esta guia
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 p-2">
                <div class="border border-dark rounded  overflow-hidden">
                    <div class="border-bottom border-dark text-center fw-bold">REMITENTE</div>
                    <p class="espaiadoPeque">
                        <span id="remitente"></span>
                        </p>
                    <div class="row">
                        <div class="col-6 border border-dark">
                            <span class="fw-bold">Valor Declarado: </span><span id="valor_declarado"></span> </div>
                        <div class="col-6 border border-dark">
                            <span class="fw-bold">Valor Seguro:</span><span id="valor_seguro"></span> </div>
                        <div class="col-6 small fw-bold">Firma Remitente:</div>
                        <div class="col-6 border border-dark">
                            <span class="fw-bold">Valuacion: </span><span id="valuacion"></span>
                            
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6 border border-dark">
                            <span class="fw-bold">Valor del envio: </span><span id="valor_envio"></span>
                        </div>
                        <div class="col-6 border border-dark small">
                            <div class="fw-bold">Nombre:</div>
                        </div>
                        <div class="col-6 border border-dark small">
                            <span class="fw-bold">Otros Cargos:</span><span></span>
                        </div>
                        <div class="col-6 border border-dark small">
                            <span class="fw-bold">Fecha/Hora:  </span><span id="fechaHoy">24/07/2023 14:32:15</span>
                        </div>
                        <div class="col-6 border border-dark small">
                            <span class="fw-bold">Total:  </span><span id="total"></span>
                        </div>
                        <div class="col-6 small mb-3">
                            <span class="fw-bold">firma Destinatario:  </span>
                        </div>
                        <div class="col-6 small mb-3">
                            <span class="fw-bold">Nombre:  </span>
                        </div>
                        <div class="col-4 small border-top border-dark px-3">
                            <span class="fw-bold">Fecha:  </span>
                        </div>
                        <div class="col-4 small border-top border-dark">
                            <span class="fw-bold">Hora:  </span>
                        </div>
                        <div class="col-4 small border-top border-dark">
                            <span class="fw-bold">AM/PM:  </span>
                        </div>
                        <div class="col-12 border-dark border-top small my-2 px-3">
                            <span class="fw-bold">Elaborado por:</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once $rutaLocal . "/includes/scripts.php"; ?>
    <script src="/js/functions_printGuide.js"></script>
</body>