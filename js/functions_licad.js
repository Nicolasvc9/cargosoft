$(document).ready(function () {
  inicio_pallet();
});
let select_idruta;
let numLicad;
let btnAgregarPallets;
function getRutas() {
  $.post(
    "/controllers/GuiasController.php",
    { op: "getRutas" },
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
function getPallets() {
  $.post(
    "/controllers/LicadController.php",
    { op: "getPallets" },
    (x) => {
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
      } else {
        console.log(x);
        if ($.fn.DataTable.isDataTable("#listaPallets")) {
          $("#listaPallets").DataTable().destroy();
        }

        if (!x.response) {
          return false;
        }

        let data = [];
        let peso_total;
        x.response.forEach((val) => {
          if (val[0] == 0) {
            val[0] = "sin asignar";
          }
          data.push({
            select: `<div class="form-check">
                  <input class="form-check-input pallet-checkbox" type="checkbox" pallet="${val[0]}" id="flexCheckDefault">
              </div>`,
            pallet: `${val[0]}`,
            kg: val[1],
          });
        });
        table = $("#listaPallets").DataTable({
          data: data,
          columns: [{ data: "select" }, { data: "pallet" }, { data: "kg" }],
        });
      }
    },
    "json"
  );
}

function deleteGuiaPallet(x) {
  $.post(
    "/controllers/GuiasController.php",
    { op: "deleteGuiaPallet", guia: x },
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
      } else {
        btnListarGuiasPallet.trigger("click");
        return Swal.fire({
          title: "la guia se a liberado del pallet",
          icon: "success",
          confirmButtonText: "Confirmar",
          timer: 5000,
          timerProgressBar: true,
        });
      }
    },
    "json"
  );
}
function inicio_pallet() {
  select_idruta = $("#select_idruta");
  numLicad = $("#numLicad");
  btnAgregarPallets = $("#btnAgregarPallets");
  getPallets();
  getRutas();
  $("#selectAllCheck").click(function() {
    var isChecked = $(this).prop("checked");
    $(".pallet-checkbox").prop("checked", isChecked);
  });   

  select_idruta.change(function (e) {
    let ruta = $(this).val();
    console.log(ruta);
    $.post(
      "/controllers/LicadController.php",
      { op: "getConsecutivoLicad", ruta },
      (x) => {
        console.log(x);
        numLicad.val(x.response.consecutivo);
      },
      "json"
    );
  });

  btnAgregarPallets.click(function (e) {
    e.preventDefault();
    console.log("AGREGANDO");
    let checkboxesSeleccionados = $("input.pallet-checkbox:checked");
    let dataGuias = [];
    checkboxesSeleccionados.each(function (e) {
      var guiaCheckbox = $(this); // Obtener el checkbox actual
      var guiaValor = guiaCheckbox.attr("pallet");
      console.log(guiaValor);
      dataGuias.push(guiaValor);
    });
    console.log(dataGuias);
  });
}
