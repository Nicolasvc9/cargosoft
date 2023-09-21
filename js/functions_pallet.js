$(document).ready(function () {
  inicio_pallet();
  getRutas();
});
let filtroGuias;
let select_ruta;
let select_tipoenvio;
let desde;
let hasta;
let tablaGuias;
let btnAsignarPallet;
let select_pallet;
let btnListarGuiasPallet;
let select_palletListar


function getRutas() {
  console.log("get rutas palets");
  $.post(
    "/controllers/GuiasController.php",
    { op: "getRutasP" },
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
        select_ruta.append(
          `<option value="${val[0]}">[${val[3]}] ${val[2]} -> [${val[6]}] ${val[5]}</option>`
        );
      });
    },
    "json"
  );
}
function deleteGuiaPallet(x) {
  $.post(
    "/controllers/GuiasController.php",
    { op: "deleteGuiaPallet", guia: x},
    (x) => {
      if (!x.status) {
        return Swal.fire({
          title: "error",
          icon: "warning",
          confirmButtonText: "Crear ruta",
          timer: 5000,
          timerProgressBar: true,
          willClose: () => {
            location.href = "../tablas/rutas";
          },
        });
      }else{
        btnListarGuiasPallet.trigger("click")
        return Swal.fire({
          title: "la guia se a liberado del pallet",
          icon: "success",
          confirmButtonText: "Confirmar",
          timer: 5000,
          timerProgressBar: true
        });
      }
      
    },
    "json"
  );
}
function inicio_pallet() {
  filtroGuias = $("#filtroGuias");
  select_ruta = $("#select_ruta");
  select_tipoenvio = $("#select_tipoenvio");
  desde = $("#desde");
  hasta = $("#hasta");
  tablaGuias = $("#tablaGuias");
  btnAsignarPallet = $("#btnAsignarPallet");
  select_pallet = $("#select_pallet");
  btnListarGuiasPallet = $("#btnListarGuiasPallet");
  select_palletListar = $("#select_palletListar");

  filtroGuias.submit(function (e) {
    e.preventDefault();
    if (
      select_ruta.val() != 0 &&
      select_ruta.val() != null &&
      select_tipoenvio.val() != "" &&
      select_tipoenvio.val() != null &&
      desde.val() != "" &&
      hasta.val() != ""
    ) {
      $.post(
        "/controllers/GuiasController.php",
        {
          op: "getGuiasPallet",
          ruta: select_ruta.val(),
          tipo: select_tipoenvio.val(),
          desde: desde.val(),
          hasta: hasta.val(),
        },
        (x) => {
          console.log(x);
          // inicio
          if (x.response) {
            if ($.fn.DataTable.isDataTable("#tablaGuias")) {
              // Destruir el DataTable existente
              $('#tablaGuias').DataTable().destroy();
            }

            if (!x.response) {
              return false;
            }

            let data = [];
            x.response.forEach((val) => {
              console.log(val);
              data.push({
                select: `<div class="form-check">
                      <input class="form-check-input guia-checkbox" type="checkbox" pallet="${val[0]}" id="flexCheckDefault">
                  </div>`,
                guia: `${val[1]}`,
                kgGuia: val[2],
                kgPallet: val[2],
                nombre: val[3],
                acciones: `
                        <button onclick="editarkg(${val[0]})" class="btn btn-sm bg_primary text_primary"><i class="fas fa-pen"></i></button>
                      `,
              });
            });
            table = $("#tablaGuias").DataTable({
              data: data,
              columns: [
                { data: "select" },
                { data: "guia" },
                { data: "kgGuia" },
                { data: "kgPallet" },
                { data: "nombre" },
                { data: "acciones" },
              ],
            });
          }else{
                  $("#tablaGuias").html(`<thead>
                  <tr>
                      <th>-</th>
                      <th># Guía</th>
                      <th>Kilos Guía</th>
                      <th>Kilos Licad</th>
                      <th>Remitente</th>
                      <th>Acciones</th>
                  </tr>
              </thead>`)
                  
              
          }

          // fin
        },
        "json"
      );
    } else {
      console.log("faltan");
    }
  });
  btnAsignarPallet.click(function (e) {
    e.preventDefault();
    console.log(`pallet seleccionado ${select_pallet.val()}`);
    if (select_pallet.val() == 0 || select_pallet.val() == null) {
      Swal.fire({
        title: "Error",
        icon: "warning",
        confirmButtonText: "Seleccione un pallet",
        timer: 3000,
        timerProgressBar: true,
      });
      return false;
    }
    let checkboxesSeleccionados = $("input.guia-checkbox:checked");
    let dataPallet = [];
    checkboxesSeleccionados.each(function (e) {
      var guiaCheckbox = $(this); // Obtener el checkbox actual
      var guiaValor = guiaCheckbox.attr("guia");
      dataPallet.push(guiaValor);
    });
    console.log(dataPallet);
    // $.post(
    //   "/controllers/PalletController.php",
    //   { op: "setPallet", data: dataPallet, pallet: select_pallet.val() },
    //   (x) => {
    //     console.log(x);
    //     if (!x.status) {
    //       return Swal.fire({
    //         title: "error",
    //         icon: "warning",
    //         confirmButtonText: "ok",
    //         timer: 5000,
    //         timerProgressBar: true
    //       });
    //     }else{
    //       filtroGuias.trigger("submit")
    //     }
        
    //   },
    //   "json"
    // );
  });
  btnListarGuiasPallet.click(function(e) {
    if(select_palletListar.val() == 0 || select_palletListar.val() == null){
      alert("por favor seleccione un aplet para listar")
    }else{
      $.post(
        "/controllers/GuiasController.php",
        {
          op: "getGuiasPalletListar",
          pallet: select_palletListar.val()
        },
        (x) => {
          console.log(x);
          // inicio
          if (x.response) {
            if ($.fn.DataTable.isDataTable("#tablaGuiasListar")) {
              $("#tablaGuiasListar").DataTable().destroy();
            }

            if (!x.response) {
              return false;
            }

            let data = [];
            x.response.forEach((val) => {
              console.log(val);
              data.push({
                guia: `${val[1]}`,
                kgGuia: val[2],
                kgPallet: val[2],
                nombre: val[3],
                acciones: `
                        <button onclick="deleteGuiaPallet(${val[0]})" class="btn btn-sm btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></button>
                      `,
              });
            });
            table = $("#tablaGuiasListar").DataTable({
              data: data,
              columns: [
                { data: "guia" },
                { data: "kgGuia" },
                { data: "kgPallet" },
                { data: "nombre" },
                { data: "acciones" },
              ],
            });
          }else{
            
                  $("#tablaGuiasListar").html(`<thead>
                  <tr>
                      <th># Guía</th>
                      <th>Kilos Guía</th>
                      <th>Kilos Licad</th>
                      <th>Remitente</th>
                      <th>Acciones</th>
                  </tr>
              </thead>`)
          }

          // fin
        }
        ,"json"
      );
    }
  })
}
