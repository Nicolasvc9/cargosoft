$(document).ready(function() {
  inicio_ciudades();
  oyentes_ciudades();
});

let modalCiudad;
let btnModalCrearCiudad;
let input_ciudad;
let input_acronimo;
let input_valorDeclarado
let input_seguro
let btnAccionCiudad;
let lista_ciudades;

let table;
let infociudad;

function inicio_ciudades()
{
  modalCiudad = $("#modalCiudad");
  btnModalCrearCiudad = $("#btnModalCrearCiudad");
  input_ciudad = $("#input_ciudad");
  input_acronimo = $("#input_acronimo");
  input_valorDeclarado = $("#input_valorDeclarado");
  input_seguro = $("#input_seguro");
  btnAccionCiudad = $("#btnAccionCiudad");
  lista_ciudades = $("#lista_ciudades");

  // $("#modalCiudad").modal("show");
}

function oyentes_ciudades()
{
  btnModalCrearCiudad.click(function () {
    btnAccionCiudad.removeAttr("idciudad").html(`<i class="fas fa-plus"></i> Crear ciudad`);
    modalCiudad.modal("show");
  });

  btnAccionCiudad.click(function () {
    accionCiudad();
  });
}


function accionCiudad()
{
  if (validarFormulario()) {
    $.post("/controllers/CityController.php", {
      op: btnAccionCiudad.attr("idciudad") ? "update" : "set",
      idciudad: btnAccionCiudad.attr("idciudad"),
      acronimo: input_acronimo.val(),
      valdeclarado: input_valorDeclarado.val(),
      seguro: input_seguro.val(),
      ciudad: input_ciudad.val()
    }, respuesta_accionCiudad, "json");
  }
}

function respuesta_accionCiudad(x)
{
  if (!x.status) {
    return Swal.fire({ title: x.status_detail, icon: "error", timer: 900, timerProgressBar: true });
  }

  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    timer: 800, timerProgressBar: true,
    willClose: () => {
      getCiudades();
      modalCiudad.modal("hide");
      input_acronimo.val("");
      input_ciudad.val("");
      input_valorDeclarado.val("");
    }
  });
}

function editarCiudad(idciudad)
{
  $.post("/controllers/CityController.php", { op: "getCiudad", idciudad: idciudad }, (x) => {
    input_ciudad.val(x.response.city);
    input_acronimo.val(x.response.acronym);
    input_seguro.val(x.response.seguro)
    input_valorDeclarado.val(x.response.valor_minimo_declarado)
    btnAccionCiudad.attr("idciudad", x.response.id).html(`<i class="fas fa-pen"></i> Actualizar`);
  
    $(modalCiudad).modal("show");
  }, "json");
}

function validarFormulario()
{
  if (input_ciudad.val() == "") {
    Swal.fire({ title: "Digita el nombre de la ciudad", icon: "warning" });
    return false;
  }
  if (input_acronimo.val() == "") {
    Swal.fire({ title: "Digita un acrónimo", icon: "warning" });
    return false;
  }
  if (input_valorDeclarado.val() == "" || input_valorDeclarado.val() <= 0) {
    Swal.fire({ title: "Digita un valor declarado valido", icon: "warning" });
    return false;
  }

  return true;
}

function getCiudades()
{
  $.post("/controllers/CityController.php", { op: "getCiudades" }, respuesta_getCiudades, "json");
}

function respuesta_getCiudades(x)
{
  if (!x.response) {
    return lista_ciudades.html(`No hay ciudades creadas.`);
  }

  if ($.fn.DataTable.isDataTable('#lista_ciudades')) {
    table.destroy();
  }

  let data = [];
  x.response.forEach(val => {
    data.push({
        "acronym": val[1],
        "ciudad": val[2],
        "valDeclarado": val[3],
        "seguro": val[4],
        "acciones": `
          <button onclick="editarCiudad(${val[0]})" class="btn btn-sm bg_primary text_primary"><i class="fas fa-pen"></i></button>
        `,
    });
  });

  table = $('#lista_ciudades').DataTable({
    data: data,
    columns: [
      { data: 'acronym' },
      { data: 'ciudad' },
      { data: 'valDeclarado' },
      { data: 'seguro' },
      { data: 'acciones' }
    ]
  });
}
