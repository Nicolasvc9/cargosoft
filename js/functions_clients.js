$(document).ready(function() {
  inicio_clientes();
  oyentes_clientes();
});

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
let seguro
let modalCliente;
let btnAccionCliente;

let lista_clientes;
let table;

function inicio_clientes()
{
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
  modalCliente = $("#modalCliente");
  btnAccionCliente = $("#btnAccionCliente");

  lista_clientes = $("#lista_clientes");

  getTiposDocumento();
  getCiudades();

  select_idcity.change(function(){
    $.post("/controllers/ClientController.php", {
      op: "getSeguro",
      city: select_idcity.val()
    }, (x) => {
      console.log(x);
      seguro.val(x.response[0]);
    }, "json");
  })
}

function oyentes_clientes()
{
  btnModalCrearCliente.click(function () {
    btnAccionCliente.removeAttr("idcliente").html(`<i class="fas fa-plus"></i> Crear`);
    modalCliente.modal("show");
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

  btnAccionCliente.click(function () {
    accionCliente();
  });
}

function accionCliente()
{
  if (validarFormulario()) {
    $.post("/controllers/ClientController.php", {
      op: btnAccionCliente.attr("idcliente") ? "update" : "set",
      idcliente: btnAccionCliente.attr("idcliente"),
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
      seguro: seguro.val()
    }, respuesta_accionCliente, "json");
  }
}

function respuesta_accionCliente(x)
{
  console.log(x);
  if (!x.status) {
    return Swal.fire({ title: x.status_detail, icon: "error", timer: 1100, timerProgressBar: true });
  }

  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    timer: 900, timerProgressBar: true,
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
      seguro.val(0)
    }
  });
}

function validarFormulario()
{
  if (select_document_type.val() == "" || select_document_type.val() == null) {
    Swal.fire({ title: "Seleccione un tipo de documento", icon: "warning", timer: 1100, timerProgressBar: true });
    return false;
  }

  if (input_document.val() == "") {
    Swal.fire({ title: "Digite un documento", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_dv.val() == "" && !input_dv.attr("disabled")) {
    Swal.fire({ title: "Digite un DV", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_first_name.val() == "" && !input_first_name.attr("disabled")) {
    Swal.fire({ title: "Digite el primer nombre", icon: "warning", timer: 1000, timerProgressBar: true });
    return false;
  }
    
  if (input_first_surname.val() == "" && !input_first_surname.attr("disabled")) {
    Swal.fire({ title: "Digite el primer apellido", icon: "warning", timer: 1000, timerProgressBar: true });
    return false;
  }
    
  if (input_business_name.val() == "" && !input_business_name.attr("disabled")) {
    Swal.fire({ title: "Digite la razón social", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_direction.val() == "") {
    Swal.fire({ title: "Digite la dirección", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_phone.val() == "") {
    Swal.fire({ title: "Digite un teléfono", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_email.val() == "") {
    Swal.fire({ title: "Digite un correo", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (select_idcity.val() == "" || select_idcity.val() == null) {
    Swal.fire({ title: "Seleccione una ciudad...", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  if(seguro.val() === 0 || seguro.val() === null){
    Swal.fire({ title: "se le aplicara el % de seguro estandar a la ciudad que escogio", icon: "warning", timer: 800, timerProgressBar: true });
  }

  return true;
}

function getTiposDocumento()
{
  $.post("/controllers/ClientController.php", { op: "getTiposDocumento" }, (x) => {
    x.response.forEach(val => {
      select_document_type.append(`<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`);
    });
  }, "json");
}

function getCiudades()
{
  $.post("/controllers/ClientController.php", { op: "getCiudades" }, (x) => {
    x.response.forEach(val => {
      select_idcity.append(`<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`);
    });
  }, "json");
}

function editarCliente(idcliente)
{
  $.post("/controllers/ClientController.php", { op: "getCliente", idcliente: idcliente }, (x) => {
    select_document_type.val(x.response.iddocument_type).trigger("change");
    input_document.val(x.response.document);
    input_dv.val(x.response.dv);
    input_first_name.val(x.response.first_name);
    input_second_name.val(x.response.second_name);
    input_first_surname.val(x.response.first_surname);
    input_second_surname.val(x.response.second_surname);
    input_business_name.val(x.response.business_name);
    input_direction.val(x.response.direction);
    input_phone.val(x.response.phone);
    input_email.val(x.response.email);
    select_idcity.val(x.response.idcity);
    btnAccionCliente.attr("idcliente", x.response.id).html(`<i class="fas fa-pen"></i> Actualizar`);

    modalCliente.modal("show");
  }, "json");
}

function getClientes()
{
  $.post("/controllers/ClientController.php", { op: "getClientes" }, respuesta_getClientes, "json");
}

function respuesta_getClientes(x)
{
  if ($.fn.DataTable.isDataTable('#lista_clientes')) {
    table.destroy();
  }

  if (!x.response) {
    return false;
  }

  let data = [];
  x.response.forEach(val => {
    console.log(val);
    data.push({
        "document_type": `[${val[1]}] ${val[2]}`,
        "document": val[3],
        "dv": val[4],
        "first_name": val[5],
        "second_name": val[6],
        "first_surname": val[7],
        "second_surname": val[8],
        "business_name": val[9],
        "direction": val[10],
        "phone": val[11],
        "email": val[12],
        "city": val[13],
        "seguro": val[14],
        "acciones": `
          <button onclick="editarCliente(${val[0]})" class="btn btn-sm bg_primary text_primary"><i class="fas fa-pen"></i></button>
        `,
    });
  });

  table = $('#lista_clientes').DataTable({
    data: data,
    columns: [
      { data: 'document_type' },
      { data: 'document' },
      { data: 'dv' },
      { data: 'first_name' },
      { data: 'second_name' },
      { data: 'first_surname' },
      { data: 'second_surname' },
      { data: 'business_name' },
      { data: 'direction' },
      { data: 'phone' },
      { data: 'email' },
      { data: 'city' },
      { data: 'seguro' },
      { data: 'acciones' }
    ],
    columnDefs: [
      { width: '20px', targets: 10 } // Establece un ancho de 200 píxeles para la primera columna (índice 0)
    ]
    // responsive: true
    
  });
}
