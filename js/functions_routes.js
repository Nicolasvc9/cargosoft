$(document).ready(function() {
  inicio_ciudades();
  oyentes_ciudades();
})

let btnModalCrearRuta
let lista_rutas
let select_idcity_origin
let select_idcity_destiny
let check_activo
let flete
let fleteCom
let btnAccionRuta
let modalRuta
let table
let gasolina

function inicio_ciudades()
{
  btnModalCrearRuta = $("#btnModalCrearRuta")
  lista_rutas = $("#lista_rutas")
  select_idcity_origin = $("#select_idcity_origin")
  select_idcity_destiny = $("#select_idcity_destiny")
  check_activo = $("#check_activo")
  flete = $("#flete")
  fleteCom = $("#fleteCom")
  btnAccionRuta = $("#btnAccionRuta")
  modalRuta = $("#modalRuta")
  gasolina = $("#gasolina")

  getCiudades();
  // modalRuta.modal("show");
}

function oyentes_ciudades()
{
  btnModalCrearRuta.click(function () {
    check_activo.prop("checked", true)
    btnAccionRuta.removeAttr("idruta").html(`<i class="fas fa-plus"></i> Crear ruta`)
    modalRuta.modal("show")
  });

  select_idcity_origin.change(function () {
    select_idcity_destiny.val(" ")
    $(`#select_idcity_destiny option`).removeAttr("hidden")
    $(`#select_idcity_destiny option[value='${select_idcity_origin.val()}']`).attr("hidden", true)
  });

  btnAccionRuta.click(function () {
    accionRuta();
  });
}

function accionRuta()
{
  if (validarFormulario()) {
    $.post("/controllers/RouteController.php", {
      op: btnAccionRuta.attr("idruta") ? "update" : "set",
      idruta: btnAccionRuta.attr("idruta"),
      idcity_origin: select_idcity_origin.val(),
      idcity_destiny: select_idcity_destiny.val(),
      status: check_activo.is(":checked") ? 1 : 0,
      flete: flete.val(),
      flete_comercial: fleteCom.val(),
      gasolina: gasolina.val(),
    }, respuesta_accionCiudad, "json");
  }
}

function respuesta_accionCiudad(x)
{
  modalRuta.modal("hide");
  getRutas();
  if (!x.status) {
    return Swal.fire({ title: x.status_detail, icon: "error", timer: 800, timerProgressBar: true, });
  }
  
  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    timer: 800, timerProgressBar: true,
    willClose: () => {
      getRutas();
      select_idcity_origin.val("");
      select_idcity_destiny.val("");
      flete.val("");
      fleteCom.val("");
      gasolina.val("");
      check_activo.prop("checked", false);
    }
  });
}

function validarFormulario()
{
  if (select_idcity_origin.val() == "" || select_idcity_origin.val() == null) {
    Swal.fire({ title: "Selecciona una ciudad origen", icon: "warning" });
    return false;
  }

  if (select_idcity_destiny.val() == "" || select_idcity_destiny.val() == null) {
    Swal.fire({ title: "Selecciona una ciudad destino", icon: "warning" });
    return false;
  }
  if (flete.val() == "" || flete.val() == null || flete.val() == 0) {
    Swal.fire({ title: "Selecciona un flete valido", icon: "warning" });
    return false;
  }
  if (fleteCom.val() == "" || fleteCom.val() == null || fleteCom.val() == 0) {
    Swal.fire({ title: "Selecciona un flete comercial valido", icon: "warning" });
    return false;
  }
  if (gasolina.val() == "" || gasolina.val() == null || gasolina.val() == 0) {
    Swal.fire({ title: "Selecciona un valor de gasolina valido", icon: "warning" });
    return false;
  }

  if (Number(select_idcity_origin.val()) == Number(select_idcity_destiny.val())) {
    Swal.fire({ title: "No puedes crear una ruta para la misma ciudad", icon: "warning" });
    return false;
  }
  
  return true;
}

function getCiudades()
{
  $.post("/controllers/RouteController.php", {op: "getCiudades"}, (x) => {
    if (!x.response) {
      console.log(x);
      // return Swal.fire({ title: x.status_detail, icon: "error" });
      return Swal.fire({
          title: x.status_detail,
          icon: "warning",
          confirmButtonText: 'Crear ciudad',
          timer: 10000, timerProgressBar: true,
          willClose: () => {
              location.href = "../ciudades";
          }
      });
    }

    x.response.forEach(val => {
      select_idcity_origin.append(`<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`);
      select_idcity_destiny.append(`<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`);
    });
  }, "json");
}

function editarRuta(idruta)
{
  $.post("/controllers/RouteController.php", {op: "getRuta", idruta: idruta}, (x) => {
    console.log("fleteeee");
    console.log(x);
    if (!x.response) {
      return Swal.fire({ title: x.status_detail, icon: "error" });
    }

    select_idcity_origin.val(x.response.idcity_origin).trigger("change");
    select_idcity_destiny.val(x.response.idcity_destiny)
    flete.val(x.response.flete)
    fleteCom.val(x.response.fletecom)
    gasolina.val(x.response.gasolina)
    check_activo.prop("checked", Number(x.response.status) > 0 ? true : false);
    btnAccionRuta.attr("idruta", x.response.id).html(`<i class="fas fa-pen"></i> Actualizar`);

    modalRuta.modal("show");
  }, "json");
}

function getRutas()
{
  $.post("/controllers/RouteController.php", {op: "getRutas"}, respuesta_getRutas, "json");
}

function respuesta_getRutas(x)
{
  console.log(x);
  if (!x.response) {
    return lista_rutas.hide();
  }

  if ($.fn.DataTable.isDataTable('#lista_rutas')) {
    table.destroy();
  }

  let data = [];
  x.response.forEach(val => {
    console.log(val);
    data.push({
        "origin": `[${val[3]}] ${val[2]}`,
        "destiny": `[${val[6]}] ${val[5]}`,
        "status": Number(val[7]) > 0 ? "<span class='badge rounded-pill badge-success'>Activa</span>" : "<span class='badge rounded-pill badge-warning'>Inactiva</span>",
        "flete": `$ ${val[8]}`,
        "fleteCom": `$ ${val[9]}`,
        "gasolina": `$ ${val[10]}`,
        "actions": `
        <button onclick="editarRuta(${val[0]})" class="btn btn-sm bg_primary text_primary"><i class="fas fa-pen"></i></button>
        `,
    });
  });

  table = $('#lista_rutas').DataTable({
    data: data,
    columns: [
      { data: 'origin' },
      { data: 'destiny' },
      { data: 'status' },
      { data: 'flete' },
      { data: 'fleteCom' },
      { data: 'gasolina' },
      { data: 'actions' }
    ]
  });
}
