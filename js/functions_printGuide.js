$(document).ready(function () {
  inicio_printGuide();
});
let btnImprimir;
let documentoImp;

function formatDate(dateString) {
  const date = new Date(dateString + "T00:00:00Z"); // Agregamos "T00:00:00Z" para indicar que es medianoche en UTC
  const year = date.getUTCFullYear();
  const month = ("0" + (date.getUTCMonth() + 1)).slice(-2);
  const day = ("0" + date.getUTCDate()).slice(-2);
  return `${day}/${month}/${year}`;
}
function inicio_printGuide() {
  let urlParams = new URLSearchParams(window.location.search);
  let guia = urlParams.get("g");

  btnImprimir = $("#btnImprimir");
  documentoImp = $("#documentoImp");
  // window.print();

  btnImprimir.click(function (e) {
    e.preventDefault();
    window.print();
  });

  if (guia) {
    $.ajax({
      url: "/controllers/GuiasController.php",
      type: "POST",
      data: {
        op: "getDataPrint",
        guia,
      },
      success: function (response) {
        console.log(response);
        let data = JSON.parse(response);
        console.log(data);
        let adicionales;
        let txtAdicionales = " / "
        if(data.guia.adicionales) {
        adicionales = JSON.parse(data.guia.adicionales)
        console.log("adicionales: ");
        adicionales.forEach(element => {
          if(element.valor != 0){
            const modifiedString = element.nombre.replace("aditional", "");
            txtAdicionales += modifiedString + " " + element.valor + " / "
          }
        });
        console.log(txtAdicionales);
        }
        // $("#guiaNumero").text(data.response.guia)
        $("#origen").text(data.origen);
        $("#destino").text(data.destino);
        console.log(data.guia.create_at);
        let fechaFormateada = formatDate(data.guia.create_at);
        console.log(fechaFormateada);
        $("#numGuia").text(data.guia.guia)
        $("#fecha").text(fechaFormateada);
        if (data.guia.way_to_pay == 0) {
          $("#formapago").text("ESTANDAR");
        } else {
          $("#formapago").text("CONTRAENTREGA");
        }
        $("#destinatario")
          .html(`Doc: ${data.destinatario.document} / Cel: ${data.destinatario.phone}<br>
              ${data.destinatario.business_name} 
              <br> Dir: ${data.destinatario.direction} 
              <br> Email: ${data.destinatario.email}
              `);
        $("#remitente")
          .html(`Doc: ${data.remitente.document} / Cel: ${data.remitente.phone}<br>
              ${data.remitente.business_name} 
              <br> Dir: ${data.remitente.direction}
              <br> Email ${data.remitente.email}
              `);
        $("#piezas").text(data.guia.parts);
        $("#kg").text(data.guia.kg);
        $("#vol").text(data.guia.vol);
        $("#tarifa").text(data.guia.tarifa_combustible);
        $("#detalle").text(`${data.guia.content} / ${data.guia.observations} /viaja embalaje bajo responsabilidad del cliente / carga sujeta a cupo ${txtAdicionales}`);
        $("#valor_declarado").text(data.guia.valor_declarado);
        $("#valor_seguro").text(data.guia.valor_seguro);
        $("#valuacion").text(data.guia.valuacion);
        $("#valor_envio").text(data.guia.valor_envio);
        $("#total").text(data.guia.total);
        // Obtener la fecha y hora actual
        const now = new Date();

        // Obtener los componentes de fecha y hora
        const day = ("0" + now.getDate()).slice(-2);
        const month = ("0" + (now.getMonth() + 1)).slice(-2);
        const year = now.getFullYear();
        const hours = ("0" + now.getHours()).slice(-2);
        const minutes = ("0" + now.getMinutes()).slice(-2);
        const seconds = ("0" + now.getSeconds()).slice(-2);

        // Formatear la fecha y hora
        $("#fechaHoy").text(`${day}/${month}/${year} ${hours}:${minutes}:${seconds}`)

        // $("#nombreDestinatario").text(data.response.des_nombre)
        // $("#ciudadDestino").text(data.response.city)
        // $("#descripcion").text(data.response.content)
        // $("#piezas").text(data.response.parts)
        // $("#kilos").text(data.response.kg)
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  } else {
    console.log("incorrecto");
    Swal.fire({
      title: "Faltan parametros",
      text: "intentelo de nuevo o comuniquese con un administrador",
      icon: "warning",
      timer: 2500,
      timerProgressBar: true,
      willClose: () => {
        window.location.href = "../../";
      },
    });
  }

  // Hacer algo con el valor del idcliente
}
