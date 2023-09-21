$(document).ready(function (){
    inicio_cartaRes()
})
let btnImprimir
let documentoImp


function inicio_cartaRes(){
    let urlParams = new URLSearchParams(window.location.search);
    let idcliente = urlParams.get("id");
    let guia = urlParams.get("guia");

    btnImprimir = $("#btnImprimir")
    documentoImp = $("#documentoImp")
    // window.print(); 

    btnImprimir.click(function(e){
        e.preventDefault();
        window.print(); 
    })
    if(idcliente && guia){
        $.ajax({
            url: "/controllers/CartaResController.php",
            type: "POST",
            data: {
              op: "get",
              guia,
            },
            success: function (response) {
            //   console.log(response);
              let data = JSON.parse(response)
              console.log(data);
              $("#guiaNumero").text(data.response.guia)
              $("#nombreDestinatario").text(data.response.des_nombre)
              $("#ciudadDestino").text(data.response.city)
              $("#descripcion").text(data.response.content)
              $("#piezas").text(data.response.parts)
              $("#kilos").text(data.response.kg)
            },
            error: function (xhr, status, error) {
              console.error(error);
            },
          });
    }else{
        console.log("incorrecto");
        Swal.fire({
            title: "Faltan parametros",
            text: "intentelo de nuevo o comuniquese con un administrador",
            icon: "warning",
            timer: 2500, timerProgressBar: true,
            willClose: () => {
                window.location.href = "../../";
              }
        })
    }


    // Hacer algo con el valor del idcliente
}