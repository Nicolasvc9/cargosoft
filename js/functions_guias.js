$(document).ready(function () {
  inicio_guias();
});
// modal addclient
let btnAccionCliente;
let btnmodalCliente;
let modalCliente;
let btnModalCrearCliente;
let select_document_type;
let input_document;
let input_dv;
let input_first_name;
let input_second_name;
let input_first_surname;
let input_second_surname;
let input_business_name;
let input_direction;
let input_phone;
let input_email;
let select_idcity;
let seguro;
// fin modal
let select_idruta;
let select_iddestinario;
let select_idremitente;
let select_idproducto;
let select_idmetodopago;
let input_flete;
let valDeclarado;
let seguroG;
let valSeguro;
let valEnvio;
let valorTotal;
let tarifaCombustible;
let valorCombustible;
let comercialCheckbox;
let input_piezas;
let input_kilos;
let input_volumen;
let btnEtiquetas;
let numGuia;
let contenido;
let observaciones;
let pagaRemitenteCheck;
let btnGuadaCambios;
let adicionales;
let btnAdicionales;
let guia = null;
let guiaC = null;
let divEtiquetas;
let btnCarta;
let modalCartaResponsabilidad;
let hayHuellero;
let btnGuardarImg;
let btnCartaRes;
let btnEtiquetasCopy;
let productosEspeciales;
let valuacion;
let btnImprimirGuia;

let origen;
let destino;
let special;

let aditionalDomicilio;
let aditionalEmbalaje;
let aditionalRecogida;
let aditionalHuacales;
let aditionalShiper;
let aditionalPeligrosa;
let aditionalOtros;

let totalAdicional = 0
let jsonAdicionales

function inicio_guias() {
  // modal addcliente
  btnAccionCliente = $("#btnAccionCliente");
  btnmodalCliente = $("#btnmodalCliente");
  modalCliente = $("#modalCliente");
  btnModalCrearCliente = $("#btnModalCrearCliente");
  select_document_type = $("#select_document_type");
  input_document = $("#input_document");
  input_dv = $("#input_dv");
  input_first_name = $("#input_first_name");
  input_second_name = $("#input_second_name");
  input_first_surname = $("#input_first_surname");
  input_second_surname = $("#input_second_surname");
  input_business_name = $("#input_business_name");
  input_direction = $("#input_direction");
  input_phone = $("#input_phone");
  input_email = $("#input_email");
  select_idcity = $("#select_idcity");
  seguro = $("#seguro");
  // fin modal
  select_idruta = $("#select_idruta");
  select_iddestinario = $("#select_iddestinario");
  select_idremitente = $("#select_idremitente");
  select_idproducto = $("#select_idproducto");
  select_idmetodopago = $("#select_idmetodopago");
  input_flete = $("#input_flete");
  valDeclarado = $("#valDeclarado");
  seguroG = $("#seguroG");
  valSeguro = $("#valSeguro");
  valEnvio = $("#valEnvio");
  valorTotal = $("#valorTotal");
  tarifaCombustible = $("#tarifaCombustible");
  valorCombustible = $("#valorCombustible");
  comercialCheckbox = $("#comercialCheckbox");
  input_piezas = $("#input_piezas");
  input_kilos = $("#input_kilos");
  input_volumen = $("#input_volumen");
  btnEtiquetas = $("#btnEtiquetas");
  numGuia = $("#numGuia");
  contenido = $("#contenido");
  observaciones = $("#observaciones");
  pagaRemitenteCheck = $("#pagaRemitenteCheck");
  origen = $("#origen");
  btnGuadaCambios = $("#btnGuadaCambios");
  adicionales = $("#adicionales");
  btnAdicionales = $("#btnAdicionales");
  divEtiquetas = $("#divEtiquetas");
  btnCarta = $("#btnCarta");
  modalCartaResponsabilidad = $("#modalCartaResponsabilidad");
  hayHuellero = $("#hayHuellero");
  btnGuardarImg = $("#btnGuardarImg");
  btnCartaRes = $("#btnCartaRes");
  btnEtiquetasCopy = $("#btnEtiquetasCopy");
  productosEspeciales = $("#productosEspeciales");
  valuacion = $("#valuacion");
  btnImprimirGuia = $("#btnImprimirGuia");
  aditionalDomicilio = $("#aditionalDomicilio");
  aditionalEmbalaje = $("#aditionalEmbalaje");
  aditionalRecogida = $("#aditionalRecogida");
  aditionalHuacales = $("#aditionalHuacales");
  aditionalShiper = $("#aditionalShiper");
  aditionalPeligrosa = $("#aditionalPeligrosa");
  aditionalOtros = $("#aditionalOtros");

  adicionales.hide();
  // divEtiquetas.hide()
  comercialCheckbox.prop("disabled", true);
  select_idremitente.prop("disabled", true);
  select_iddestinario.prop("disabled", true);
  contenido.prop("disabled", true);
  observaciones.prop("disabled", true);
  select_idproducto.prop("disabled", true);
  input_piezas.prop("disabled", true);
  input_kilos.prop("disabled", true);
  input_volumen.prop("disabled", true);
  input_flete.prop("disabled", true);
  // btnImprimirGuia.prop("disabled", true);
  // select_idmetodopago.prop("disabled", true);
  valDeclarado.prop("disabled", true);
  seguro.prop("disabled", true);
  seguroG.prop("disabled", true);
  tarifaCombustible.prop("disabled", true);
  pagaRemitenteCheck.prop("disabled", true);
  btnGuadaCambios.prop("disabled", true);
  btnCarta.prop("disabled", true);
  btnCartaRes.prop("disabled", true);

  // productosEspeciales.hide();
  $(".aditionals").on("input", function () {
    calcularAditionals();
  });

  comercialCheckbox.change(function (e) {
    if (
      select_idruta.val() == 0 ||
      (select_idruta.val() == undefined) | (select_idruta.val() == null)
    ) {
      return false;
    }
    console.log("cambie y tengo ruta");
    $.post(
      "/controllers/GuiasController.php",
      { op: "getFlete", ruta: select_idruta.val() },
      (x) => {
        console.log(x);
        if (comercialCheckbox.is(":checked")) {
          input_flete.val(x.response.flete_comercial);
          tarifaCombustible.val(0).prop("disabled", true).trigger("blur");
          valorCombustible.prop("disabled", true);
        } else {
          tarifaCombustible.val(x.response.gasolina).trigger("blur");
          input_flete.val(x.response.flete);
        }
        vTotal();
      },
      "json"
    );
  });
  btnAdicionales.click(function () {
    adicionales.toggle();
  });
  select_idremitente.select2();
  select_iddestinario.select2();
  select_idproducto.select2();

  getRutas()
  getClientes()
  getProductos()
  getTiposDocumento()
  getCiudades()
  getValuaion()

  btnImprimirGuia.prop("disabled", true)
  btnImprimirGuia.click(function () {
    guardarGuia()
    btnCartaRes.prop("disabled", true)
    window.open(
      `./imprimir/index.php?g=${numGuia.val()}`,
      "NombreVentana",
      "width=800,height=600"
    );
  });
  btnmodalCliente.click(function () {
    btnAccionCliente
      .removeAttr("idcliente")
      .html(`<i class="fas fa-plus"></i> Crear`);
    modalCliente.modal("show");
  });
  btnAccionCliente.click(function () {
    addClient();
  });
  select_document_type.change(function () {
    if (Number($(this).val()) === 1) {
      input_dv.removeAttr("disabled");
      input_business_name.removeAttr("disabled");
      input_first_name.attr("disabled", true).val("");
      input_second_name.attr("disabled", true).val("");
      input_first_surname.attr("disabled", true).val("");
      input_second_surname.attr("disabled", true).val("");
    } else {
      input_dv.attr("disabled", true).val("");
      input_business_name.attr("disabled", true).val("");
      input_first_name.removeAttr("disabled");
      input_second_name.removeAttr("disabled");
      input_first_surname.removeAttr("disabled");
      input_second_surname.removeAttr("disabled");
    }
  });
  valuacion.change(function (e) {
    vTotal();
  });
  select_idruta.change(function (e) {
    $.post(
      "/controllers/GuiasController.php",
      { op: "getFlete", ruta: $(this).val() },
      (x) => {
        console.log(x);
        input_flete.val(x.response.flete);
        valDeclarado.val(x.response.valor_minimo_declarado);
        destino = x.response.idcity_destiny;
        origen.val(x.response.idcity_origin).trigger("click");
        input_piezas.prop("disabled", false);
        select_idremitente.prop("disabled", false);
        select_iddestinario.prop("disabled", false);
        contenido.prop("disabled", false);
        observaciones.prop("disabled", false);
        comercialCheckbox.prop("disabled", false);
        select_idproducto.prop("disabled", false);
        input_kilos.prop("disabled", false);
        input_volumen.prop("disabled", false);
        tarifaCombustible.val(x.response.gasolina).trigger("blur");
        valueEnvio();
      },
      "json"
    );
  });
  tarifaCombustible.blur(() => {
    vCombustible();
  });
  select_idremitente.on("change", function () {
    $.post(
      "/controllers/GuiasController.php",
      { op: "getSeguro", cliente: $(this).val() },
      (x) => {
        seguroG.val(x.response.seguro).trigger("change");
      },
      "json"
    );
  });
  numGuia.val("");
  origen.click(function (e) {
    console.log("cambio el origen");
    $.post(
      "/controllers/GuiasController.php",
      { op: "getConsecutivo", ciudad: $(this).val() },
      (x) => {
        console.log(x);
        guia = x.response.consecutivo;
        numGuia.val(`${x.response.acronym}${x.response.consecutivo}`);
      },
      "json"
    );
  });
  seguroG.on("change", function (e) {
    if (valDeclarado.val() >= 1 && seguroG.val() >= 1) {
      valSeguro.val((valDeclarado.val() * seguroG.val()) / 100);
    }
    vTotal();
  });
  input_piezas.on("change keyup", function (e) {
    btnEtiquetas.prop("disabled", false);
    select_idproducto.trigger("change");
  });
  btnEtiquetasCopy.click(function () {
    let piezas = input_piezas.val();
    divEtiquetas.empty();
    let printEtiquetas = `<style>
          .page-break {
            page-break-after: always;
          }
          .girar {
            margin-left: 100mm;
            transform: rotate(90deg); 
            transform-origin: top left; 
          }
        </style>`;
    let fechaActual = new Date();
    let dia = fechaActual.getDate();
    let mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0, por lo que se suma 1
    let anio = fechaActual.getFullYear();
    let horas = fechaActual.getHours();
    let minutos = fechaActual.getMinutes();

    let horaLegible = horas + ":" + minutos;

    let fechaLegible = dia + "/" + mes + "/" + anio;
    let ruta = $("#select_idruta option:selected").text();
    let rem = $("#select_iddestinario option:selected").text();
    let remitente = rem.replace(/\[.*?\]\s*/, "");
    let tipo = "";
    if (comercialCheckbox.prop("checked")) {
      tipo = "COMERCIAL";
    }

    for (let i = 1; i <= piezas; i++) {
      printEtiquetas += `
            <div class="girar">
              <div class="display-3 fw-bold">CARIBE CARGO <b>Copia</b></div>
              <div class="display-4 fw-bold">GUIA: ${numGuia.val()}</div>
              <div class="h2 fw-bold">${tipo}</div>
              <div class="h1 fw-bold">PIEZAS: ${i} DE: ${piezas} </div>
              <div class="h2 fw-bold">FECHA: ${fechaLegible} HORA: ${horaLegible}</div>
              <div class="h2 fw-bold">${ruta}</div>
              <div class="h3 fw-bold">Destinatario:</div>
              <div class="h2 fw-bold">${remitente}</div>
            </div>
            <div class="page-break"></div>`;
      console.log("piezas: " + piezas);
      console.log("i: " + i);
    }
    divEtiquetas.html(printEtiquetas);
    divEtiquetas.show();
    divEtiquetas.printThis({
      importCSS: true,
      printContainer: true,
    });
    setTimeout(function () {
      divEtiquetas.hide();
      input_piezas.prop("disabled", true);
      comercialCheckbox.prop("disabled", true);
      btnEtiquetas.prop("disabled", true);
    }, 1500);
  });
  btnEtiquetas.click(function () {
    validarSesion(function (sesionValida) {
      if (sesionValida) {
        console.log("Sesión válida. Realizando acciones...");
        if (
          select_iddestinario.val() == null ||
          select_idproducto.val() == null
        ) {
          return Swal.fire({
            title: "Faltan datos",
            text: "seleccione un destinatario y un producto para poder imprimir etiquetas",
            icon: "warning",
            confirmButtonText: "Confirmar",
            timer: 2000,
          });
        } else {
          guardarParcial().then((resultado) => {
            console.log("resultado");
            console.log(resultado);
            if (resultado) {
              let piezas = input_piezas.val();
              divEtiquetas.empty();
              divEtiquetas.show();
              let printEtiquetas = `<style>
                .page-break {
                  page-break-after: always;
                }
                .girarr {
                  margin-left: 120mm;
                  transform: rotate(90deg); /* Aplicar rotaciÃ³n de 90 grados */
                  transform-origin: top left; /* Punto de origen de la rotaciÃ³n */
                }
              </style>
              <div class="contenedorEt">`;
              let fechaActual = new Date();
              let dia = fechaActual.getDate();
              let mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0, por lo que se suma 1
              let anio = fechaActual.getFullYear();
              let horas = fechaActual.getHours();
              let minutos = fechaActual.getMinutes();

              let horaLegible = horas + ":" + minutos;

              let fechaLegible = dia + "/" + mes + "/" + anio;
              let ruta = $("#select_idruta option:selected").text();
              let rem = $("#select_iddestinario option:selected").text();
              let remitente = rem.replace(/\[.*?\]\s*/, "");
              let tipo = "";
              if (comercialCheckbox.prop("checked")) {
                tipo = "COMERCIAL";
              }

              for (let i = 1; i <= piezas; i++) {
                printEtiquetas += `
                  <div class="girarr">
                    <div class="display-3 fw-bold">CARIBE CARGO</div>
                    <div class="display-4 fw-bold">GUIA: ${numGuia.val()}</div>
                    <div class="h2 fw-bold">${tipo}</div>
                    <div class="h1 fw-bold">PIEZAS: ${i} DE: ${piezas} </div>
                    <div class="h2 fw-bold">FECHA: ${fechaLegible} HORA: ${horaLegible}</div>
                    <div class="h2 fw-bold">${ruta}</div>
                    <div class="h3 fw-bold">Destinatario:</div>
                    <div class="h2 fw-bold">${remitente}</div>
                  </div>
                  <div class="page-break"></div>
                  `;
                console.log("piezas: " + piezas);
                console.log("i: " + i);
                // var etiqueta = $('<div class="etiqueta">Etiqueta ' + (i + 1) + '</div>');
                // etiquetasContainer.append(etiqueta);
                // etiquetasContainer.append('<div class="page-break"></div>');
              }
              printEtiquetas += "</div>";
              select_iddestinario.prop("disabled", true);
              select_idproducto.prop("disabled", true);
              divEtiquetas.html(printEtiquetas);
              divEtiquetas.printThis({
                importCSS: true,
                printContainer: true,
              });
              setTimeout(function () {
                divEtiquetas.hide();
                input_piezas.prop("disabled", true);
                comercialCheckbox.prop("disabled", true);
                btnEtiquetas.prop("disabled", true);
                btnEtiquetasCopy.prop("disabled", false);
                btnCarta.prop("disabled", false);
                select_idmetodopago.prop("disabled", false);
                input_flete.prop("disabled", false);
                valDeclarado.prop("disabled", false);
                seguro.prop("disabled", false);
                seguroG.prop("disabled", false);
                tarifaCombustible.prop("disabled", false);
              }, 1500);
            } else {
              console.log("esta repetido");
            }
          });
        }
        // Coloca aquí el código para ejecutar las acciones que deseas realizar
      } else {
        console.log("No hay una sesión activa. Acción cancelada.");
        return mostrarMensajeErrorSesion().then(function () {
          window.location.href = "/";
        });
      }
    });
  });
  btnGuadaCambios.click(function () {
    guardarGuia();
  });
  input_kilos.on("change keyup", function (e) {
    input_volumen.val(input_kilos.val());
    // select_idproducto.trigger("change");
    if (select_idproducto.val() <= 38) {
      valueEnvio();
    }
  });
  input_volumen.on("blur", function () {
    var volumen = parseFloat(input_volumen.val());
    var kilos = parseFloat(input_kilos.val());

    if (volumen < kilos) {
      input_volumen.val(kilos);
    }
    valueEnvio();
  });
  btnCarta.click(function (e) {
    hayHuellero.prop("checked", true);
    modalCartaResponsabilidad.modal("show");
  });
  btnCartaRes.click(function (e) {
    validarSesion(function (sesionValida) {
      if (sesionValida) {
        console.log("Sesión válida. Realizando acciones...");
        btnImprimirGuia.prop("disabled", false)
      } else {
        console.log("No hay una sesión activa. Acción cancelada.");
        return mostrarMensajeErrorSesion().then(function () {
          window.location.href = "/";
        });
      }
    });
    // if (validarGuia()) {
    //   console.log("se valido correcto");
    // } else {
    //   Swal.mixin({
    //     toast: true,
    //     position: "top-end",
    //     showConfirmButton: false,
    //     timer: 2000,
    //     timerProgressBar: true,
    //     didOpen: (toast) => {
    //       toast.addEventListener("mouseenter", Swal.stopTimer);
    //       toast.addEventListener("mouseleave", Swal.resumeTimer);
    //     },
    //   }).fire({
    //     icon: "error",
    //     title: "Error",
    //     text: "Debe completar todos los campos...",
    //   });
    // }
    guardarGuia();
    window.open(
      "carta_responsabilidad/index.php?id=" +
        select_idremitente.val() +
        "&guia=" +
        numGuia.val(),
      "_blank",
      "width=800, height=600"
    );
  });
  hayHuellero.change(function (e) {
    if (hayHuellero.is(":checked")) {
      console.log("activo");
    } else {
      console.log("inactivo");
    }
  });
  btnGuardarImg.click(function (e) {
    e.preventDefault();
    console.log("enviandoImg");
    Swal.fire({
      title: "¿Esta¡ seguro de que desea capturar estos datos?",
      text: "Esta accion no se podra¡ deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si­",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario confirmÃ³, ejecuta el cÃ³digo que deseas aquÃ­
        console.log("Confirmado");
        $.ajax({
          url: "/temp_data/guardarImg.php",
          type: "POST",
          data: {
            op: "GuardarImg",
            user: "admin",
            guia: numGuia.val(),
          },
          success: function (response) {
            console.log(response);
            let data = JSON.parse(response);
            if (data.status) {
              Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Captura exitosa!",
                showConfirmButton: false,
                timer: 3000,
              });
              modalCartaResponsabilidad.modal("hide");
              btnCarta.prop("disabled", true);
              btnCartaRes.prop("disabled", false);
              select_idruta.prop("disabled", true);
              select_idremitente.prop("disabled", true);
            }
          },
          error: function (xhr, status, error) {
            console.error(error);
          },
        });
        // ...
      } else {
        // El usuario cancelÃ³, puedes ejecutar un cÃ³digo alternativo aquÃ­ si es necesario
        console.log("Cancelado");
        // ...
      }
    });
  });
  select_idproducto.change(function (e) {
    var selectedOption = $(this).find("option:selected");
    var isSpecial = selectedOption.attr("especial") === "true";

    if (isSpecial) {
      productEspeciales(selectedOption.val());
    } else {
      productosEspeciales.hide();
    }
  });
}
function validarGuia() {
  let pass;
  // if (comercialCheckbox.is(":checked")) {
  // } else if (
  //   tarifaCombustible.val() === 0 ||
  //   tarifaCombustible.val() === undefined ||
  //   tarifaCombustible.val() === "" ||
  //   valorCombustible.val() === undefined ||
  //   valorCombustible.val() === 0 ||
  //   valorCombustible.val() === ""
  // ) {
  //   pass = false;
  // }

  if (
    numGuia.val() === null ||
    numGuia.val() === "" ||
    select_idremitente.val() === 0 ||
    select_iddestinario.val() === 0 ||
    contenido.val() === "" ||
    input_piezas.val() === 0 ||
    input_piezas.val() === "" ||
    input_kilos.val() === 0 ||
    input_kilos.val() === "" ||
    input_volumen.val() === 0 ||
    input_volumen.val() === "" ||
    select_idmetodopago.val() === 0
    // ||
    // input_flete.val() === 0 ||
    // input_flete.val() === "" ||
    // valDeclarado.val() === 0 ||
    // valDeclarado.val() === "" ||
    // seguro.val() === 0 ||
    // seguro.val() === "" ||
    // seguroG.val() === "" ||
    // seguroG.val() === 0 ||
    // valuacion.val() === 0 ||
    // valuacion.val() === ""
  ) {
    pass = false;
  } else {
    pass = true;
  }
  return pass;
}
function getValuaion() {
  $.post(
    "/controllers/ConfigController.php",
    { op: "getValuacion" },
    (x) => {
      console.log(x);
      valuacion.val(x.response);
    },
    "json"
  );
}
function activarCamara() {
  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then(function (stream) {
      camaraPreview.srcObject = stream;
      camaraStream = stream;
    })
    .catch(function (error) {
      console.error("Error al acceder a la cÃ¡mara: ", error);
    });
}
function desactivarCamara() {
  if (camaraStream) {
    camaraStream.getTracks().forEach(function (track) {
      track.stop();
    });
    camaraPreview.srcObject = null;
    camaraStream = null;
  }
}
function vCombustible() {
  let vCombustible =
    tarifaCombustible.val() > 0 && input_kilos.val() > 0
      ? tarifaCombustible.val() * input_kilos.val()
      : 0;
  valorCombustible.val(vCombustible);
}
function valueEnvio() {
  if (seguroG.val() > 0 && valDeclarado.val() > 0) {
    valSeguro.val((seguroG.val() * valDeclarado.val()) / 100);
  }
  let kilos;
  if (input_kilos.val() >= 1 || input_volumen.val() <= 1) {
    kilos =
      input_kilos.val() > input_volumen.val()
        ? input_kilos.val()
        : input_volumen.val();
    let valorEnvio = input_flete.val() * kilos;
    valEnvio.val(valorEnvio);
  }
  vCombustible();
  vTotal();
}
function calcularAditionals() {
  
  totalAdicional = 0;
  jsonAdicionales = [];
  $(".aditionals").each(function () {
    let nombre = $
    jsonAdicionales.push({ nombre: $(this).attr("id"), valor: $(this).val() });
    totalAdicional += parseFloat($(this).val())
  });
  console.log(jsonAdicionales);
  console.log(totalAdicional);
  vTotal()

}
function vTotal() {
  if (select_idproducto.val() >= 39) {
    console.log("no se hizo nada es especial");
    let envio = parseInt(valEnvio.val());
    let combustible = parseInt(valorCombustible.val());
    let seguro = parseInt(valSeguro.val());
    let valua = parseInt(valuacion.val());

    if (!isNaN(envio) && !isNaN(combustible) && !isNaN(seguro)) {
      let valueTotal = envio + combustible + seguro + valua + totalAdicional;
      valorTotal.val(valueTotal);
    }
    // return;
  } else {
    let envio = parseInt(valEnvio.val());
    let combustible = parseInt(valorCombustible.val());
    let seguro = parseInt(valSeguro.val());
    let valua = parseInt(valuacion.val());

    if (!isNaN(envio) && !isNaN(combustible) && !isNaN(seguro)) {
      let valueTotal = envio + combustible + seguro + valua + totalAdicional;
      valorTotal.val(valueTotal);
    }
  }
  
}
function getTiposDocumento() {
  $.post(
    "/controllers/ClientController.php",
    { op: "getTiposDocumento" },
    (x) => {
      x.response.forEach((val) => {
        select_document_type.append(
          `<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`
        );
      });
    },
    "json"
  );
}
function getCiudades() {
  $.post(
    "/controllers/ClientController.php",
    { op: "getCiudades" },
    (x) => {
      x.response.forEach((val) => {
        select_idcity.append(
          `<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`
        );
      });
    },
    "json"
  );
}
function validarFormulario() {
  if (select_document_type.val() == "" || select_document_type.val() == null) {
    Swal.fire({
      title: "Seleccione un tipo de documento",
      icon: "warning",
      timer: 1100,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_document.val() == "") {
    Swal.fire({
      title: "Digite un documento",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_dv.val() == "" && !input_dv.attr("disabled")) {
    Swal.fire({
      title: "Digite un DV",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_first_name.val() == "" && !input_first_name.attr("disabled")) {
    Swal.fire({
      title: "Digite el primer nombre",
      icon: "warning",
      timer: 1000,
      timerProgressBar: true,
    });
    return false;
  }

  if (
    input_first_surname.val() == "" &&
    !input_first_surname.attr("disabled")
  ) {
    Swal.fire({
      title: "Digite el primer apellido",
      icon: "warning",
      timer: 1000,
      timerProgressBar: true,
    });
    return false;
  }

  if (
    input_business_name.val() == "" &&
    !input_business_name.attr("disabled")
  ) {
    Swal.fire({
      title: "Digite la razÃ³n social",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_direction.val() == "") {
    Swal.fire({
      title: "Digite la direcciÃ³n",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_phone.val() == "") {
    Swal.fire({
      title: "Digite un telÃ©fono",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (input_email.val() == "") {
    Swal.fire({
      title: "Digite un correo",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }

  if (select_idcity.val() == "" || select_idcity.val() == null) {
    Swal.fire({
      title: "Seleccione una ciudad...",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
    return false;
  }
  if (seguro.val() === 0 || seguro.val() === null) {
    Swal.fire({
      title: "se le aplicara el % de seguro estandar a la ciudad que escogio",
      icon: "warning",
      timer: 800,
      timerProgressBar: true,
    });
  }

  return true;
}
function addClient() {
  if (validarFormulario()) {
    $.post(
      "/controllers/ClientController.php",
      {
        op: "set",
        iddocument_type: select_document_type.val(),
        document: input_document.val(),
        dv: input_dv.val(),
        first_name: input_first_name.val(),
        second_name: input_second_name.val(),
        first_surname: input_first_surname.val(),
        second_surname: input_second_surname.val(),
        business_name: input_business_name.val(),
        direction: input_direction.val(),
        phone: input_phone.val(),
        email: input_email.val(),
        idcity: select_idcity.val(),
        seguro: seguro.val(),
      },
      respuesta_addCliente,
      "json"
    );
  }
}
function respuesta_addCliente(x) {
  // console.log(x);
  getClientes();
  if (!x.status) {
    return Swal.fire({
      title: x.status_detail,
      icon: "error",
      timer: 1100,
      timerProgressBar: true,
    });
  }

  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    timer: 900,
    timerProgressBar: true,
    willClose: () => {
      getClientes();
      modalCliente.modal("hide");
      select_document_type.val("");
      input_document.val("");
      input_dv.val("");
      input_first_name.val("");
      input_second_name.val("");
      input_first_surname.val("");
      input_second_surname.val("");
      input_business_name.val("");
      input_direction.val("");
      input_phone.val("");
      input_email.val("");
      select_idcity.val("");
      seguro.val(0);
    },
  });
}
function guardarGuia() {
  return new Promise((resolve, reject) => {
    // console.log(numGuia.val());
    calcularAditionals()
    let comercial;
    let kg = 0;
    let pagaRem;
    if (comercialCheckbox.is(":checked")) {
      comercial = 1;
    } else {
      comercial = 0;
    }
    if (input_kilos.val() === "" && input_volumen.val() === "") {
      console.log("no se ha puesto el peso ni el volumen");
    } else if (input_kilos.val() >= input_volumen.val()) {
      kg = input_kilos.val();
    } else {
      kg = input_volumen.val();
    }
    if (pagaRemitenteCheck.is(":checked")) {
      pagaRem = 1;
    } else {
      pagaRem = 0;
    }

    $.post(
      "/controllers/GuiasController.php",
      {
        op: "setGuia",
        guia: guia,
        guiac: numGuia.val(),
        remitente: select_idremitente.val(),
        destinatario: select_iddestinario.val(),
        origen: origen.val(),
        destino: destino,
        ruta: select_idruta.val(),
        comercial: comercial,
        contenido: contenido.val(),
        observaciones: observaciones.val(),
        producto: select_idproducto.val(),
        piezas: input_piezas.val(),
        kg: input_kilos.val(),
        vol: input_volumen.val(),
        kg_vol: kg,
        flete: input_flete.val(),
        declarado: valDeclarado.val(),
        seguro: seguroG.val(),
        tarifaCombustible: tarifaCombustible.val(),
        valuacion: valuacion.val(),
        vseguro: valSeguro.val(),
        venvio: valEnvio.val(),
        valorCombustible: valorCombustible.val(),
        total: valorTotal.val(),
        actualizado: 1,
        contrapago: pagaRem,
        formadepago: select_idmetodopago.val(),
        status: 1,
        adicionales: JSON.stringify(jsonAdicionales)
      },
      (x) => {
        console.log(x);
        // if(!x.status){
        //   Swal.fire({
        //     title: x.status_detail,
        //     text: x.response,
        //     icon: "warning",
        //     confirmButtonText: 'Actualizar',
        //     timer: 5000, timerProgressBar: true,
        //   }).then((result) => {
        //     if(result.isConfirmed || result.isDimissed){
        //       select_idruta.trigger('change')
        //     }
        //     console.log(result);
        //     resolve(false)
        //   });
        // }else{
        //   resolve(true)
        // }
          console.log(x.status_detail);
          console.log(x);
      }
    );
  });
}
function guardarParcial() {
  return new Promise((resolve, reject) => {
    console.log(numGuia.val());
    calcularAditionals()
    let comercial;
    let kg = 0;
    if (comercialCheckbox.is(":checked")) {
      comercial = 1;
    } else {
      comercial = 0;
    }
    if (input_kilos.val() === "" && input_volumen.val() === "") {
      console.log("no se ha puesto el peso ni el volumen");
    } else if (input_kilos.val() >= input_volumen.val()) {
      kg = input_kilos.val();
    } else {
      kg = input_volumen.val();
    }
    
    $.post(
      "/controllers/GuiasController.php",
      {
        op: "setParcial",
        guia: guia,
        guiac: numGuia.val(),
        remitente: select_idremitente.val(),
        destinatario: select_iddestinario.val(),
        origen: origen.val(),
        destino: destino,
        ruta: select_idruta.val(),
        comercial: comercial,
        contenido: contenido.val(),
        observaciones: observaciones.val(),
        producto: select_idproducto.val(),
        piezas: input_piezas.val(),
        kg: input_kilos.val(),
        vol: input_volumen.val(),
        adicionales: JSON.stringify(jsonAdicionales)
        
      },
      (x) => {
        console.log(x);
        if (!x.status) {
          Swal.fire({
            title: x.status_detail,
            text: x.response,
            icon: "warning",
            confirmButtonText: "Actualizar",
            timer: 5000,
            timerProgressBar: true,
          }).then((result) => {
            if (result.isConfirmed || result.isDimissed) {
              select_idruta.trigger("change");
            }
            console.log(result);
            resolve(false);
          });
        } else {
          resolve(true);
        }
        console.log(x.status_detail);
        console.log(x);
      },
      "json"
    );
  });
}
function getRutas() {
  $.post(
    "/controllers/GuiasController.php",
    { op: "getRutas", origen: $("#ciudadUser").val() },
    (x) => {
      console.log(x);
      if (!x.status) {
        return Swal.fire({
          title: x.status_detail,
          icon: "warning",
          confirmButtonText: "Crear ruta",
          timer: 5000,
          timerProgressBar: true,
          willClose: () => {
            location.href = "../tablas/rutas";
          },
        });
      }

      x.response.forEach((val) => {
        select_idruta.append(
          `<option value="${val[0]}">[${val[3]}] ${val[2]} -> [${val[6]}] ${val[5]}</option>`
        );
      });
    },
    "json"
  );
}
function getClientes() {
  $.post(
    "/controllers/GuiasController.php",
    { op: "getClientes" },
    (x) => {
      if (!x.status) {
        return Swal.fire({
          title: x.status_detail,
          icon: "warning",
          confirmButtonText: "Crear cliente",
          timer: 5000,
          timerProgressBar: true,
          willClose: () => {
            location.href = "../tablas/clientes";
          },
        });
      }

      if (x.response.length <= 1) {
        return Swal.fire({
          title: "No hay suficientes clientes para generar la guÃ­a",
          icon: "warning",
          confirmButtonText: "Crear cliente",
          timer: 5000,
          timerProgressBar: true,
          willClose: () => {
            location.href = "../tablas/clientes";
          },
        });
      }

      x.response.forEach((val) => {
        select_iddestinario.append(
          `<option value="${val[0]}">[${val[3]}-${val[4]}] ${val[9]}</option>`
        );
        select_idremitente.append(
          `<option value="${val[0]}">[${val[3]}-${val[4]}] ${val[9]}</option>`
        );
      });
    },
    "json"
  );
}
function getProductos() {
  $.post(
    "/controllers/GuiasController.php",
    { op: "getProductos" },
    (x) => {
      // console.log(x);

      if (!x.status) {
        return Swal.fire({
          title: x.status_detail,
          icon: "warning",
          confirmButtonText: "Crear producto",
          timer: 5000,
          timerProgressBar: true,
          willClose: () => {
            location.href = "../tablas/productos";
          },
        });
      }

      x.response.forEach((val) => {
        let especial;
        if (val[3] == 1) {
          especial = `especial="true"`;
        }
        select_idproducto.append(
          `<option value="${val[0]}" ${especial}>[${val[1]}] ${val[2]}</option>`
        );
      });
    },
    "json"
  );
}
