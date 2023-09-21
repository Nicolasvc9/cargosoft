$(document).ready(function () {
  inicio_detallado_licad();
});

function getDetallado(licad) {
  $.post(
    "/controllers/GuiasController.php",
    { op: "getDetallado", licad },
    (x) => {
        console.log(x);
        // if ($.fn.DataTable.isDataTable("#listaPallets")) {
        //     $("#listaPallets").DataTable().destroy();
        //   }
  
        //   if (!x.response) {
        //     return false;
        //   }
  
        //   let data = [];
        //   let peso_total;
        //   x.response.forEach((val) => {
        //     if (val[0] == 0) {
        //       val[0] = "sin asignar";
        //     }
        //     data.push({
        //       select: `<div class="form-check">
        //             <input class="form-check-input pallet-checkbox" type="checkbox" pallet="${val[0]}" id="flexCheckDefault">
        //         </div>`,
        //       pallet: `${val[0]}`,
        //       kg: val[1],
        //     });
        //   });
        //   table = $("#listaPallets").DataTable({
        //     data: data,
        //     columns: [{ data: "select" }, { data: "pallet" }, { data: "kg" }],
        //   });
    },
    // "json"
  );
}

function inicio_detallado_licad() {
  const urlParams = new URLSearchParams(window.location.search);

  // Obtener el valor del parámetro "licad"
  const licadValue = urlParams.get("licad");

  // Utilizar el valor del parámetro "licad"
  console.log("Valor de licad:", licadValue);
  if(licadValue)
  {
    getDetallado(licadValue)
  }
}
