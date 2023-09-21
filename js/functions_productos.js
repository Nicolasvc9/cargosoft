$(document).ready(function() {
  inicio_productos();
  oyentes_productos();
});

// === index.php
let lista_productos;

// === show.php
let mostrar_producto;

// === edit.php
let btn_editarproducto;

// === create.php
let input_codigo;
let input_nombre;
let check_especial;
let btn_crearproducto;

function inicio_productos()
{
  // === index.php
  lista_productos = $("#lista_productos");

  // === show.php
  mostrar_producto = $("#mostrar_producto");

  // === edit.php
  btn_editarproducto = $("#btn_editarproducto");

  // === create.php
  input_codigo = $("#input_codigo");
  input_nombre = $("#input_nombre");
  check_especial = $("#check_especial");
  btn_crearproducto = $("#btn_crearproducto");
}

function oyentes_productos()
{
  btn_crearproducto.click(function () {
    create();
  });

  btn_editarproducto.click(function () {
    update();
  })
}


// === index.php
function getProductos()
{
  $.post("/controllers/ProductController.php", { op: "all" }, respuesta_getProductos, "json");
}

function respuesta_getProductos(x)
{
  if (x.response.length > 0) { 
    lista_productos.html(`<div class="col-12 text-secondary">Mostrando ${x.response.length} resultados.</div>`);
    x.response.forEach(val => {
      lista_productos.append(`
        <div class="col-12 col-sm-4 col-md-3">
          <div onclick="selectProducto(${val[0]})" class="btn bg-white shadow-sm rounded-3 px-3 py-2 w-100 text-left">
            <small class="text-secondary">${val[1]}</small>
            <div class="fw-bolder">${val[2]}</div>
          </div>
        </div>`);
    });
  } else {
    lista_productos.html("No hay productos creados");
  }
}

function selectProducto(idproducto) {
  return location.href = `./show.php?idp=${idproducto}`;
}


// === show.php
function getProducto(idproducto)
{
  $.post("/controllers/ProductController.php", { op: "get", idproducto: idproducto }, respuesta_getProducto, "json");
}

function respuesta_getProducto(x)
{
  if (x.response.length > 0) {
    let val = x.response;
    mostrar_producto.html(`
      <div class="bg-white w-full p-4 rounded-3 shadow-3">
        ${Number(val[3]) > 0 ? `<span class="badge badge-success">Producto especial</span>` : `` }
        <h3 class="mt-2">
          <span class="text-secondary">#${val[1]} | </span>
          <span class="fw-bolder">${val[2]}</span>
        </h3>
      </div>`);
  } else {
    mostrar_producto.html("EL PRODUCTO NO SE HA ENCONTRADO");
  }
}

// === edit.php
function editProducto(idproducto)
{
  $.post("/controllers/ProductController.php", { op: "get", idproducto: idproducto }, (x) => {
    input_codigo.val(x.response[1]);
    input_nombre.val(x.response[2]);
    check_especial.prop("checked", Number(x.response[3]));
  }, "json");
}

function update()
{
  if (validarFormulario()) {
    $.post("/controllers/ProductController.php", {
      op: "update",
      idproducto: btn_editarproducto.attr("idproducto"),
      codigo: input_codigo.val(),
      nombre: input_nombre.val(),
      especial: check_especial.is(":checked") ? 1 : 0,
    }, respuesta_update, "json");
  }
}

function respuesta_update(x)
{
  console.log(x)
  if (!x.status) {
    Swal.fire({ title: x.status_detail, icon: "error" });
  }

  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    confirmButtonText: "Aceptar",
    timer: 800, timerProgressBar: true,
    willClose: () => {
      location.href = `./show.php?idp=${x.response}`;
    }
  });
}


// === create.php
function create()
{
  if (validarFormulario()) {
    $.post("/controllers/ProductController.php", {
      op:"set",
      codigo: input_codigo.val(),
      nombre: input_nombre.val(),
      especial: check_especial.is(":checked") ? 1 : 0,
    }, respuesta_create, "json");
  }
}

function respuesta_create(x)
{
  if (!x.status) {
    return Swal.fire({
      title: x.status_detail,
      icon: "error",
      timer: 2000, timerProgressBar: true,
      confirmButtonText: "Ver producto",
      showCancelButton: true, cancelButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = `./show.php?idp=${x.response}`;
      }
    });
  }

  return Swal.fire({
    title: x.status_detail,
    icon: "success",
    confirmButtonText: "Aceptar",
    timer: 800, timerProgressBar: true,
    willClose: () => {
      location.href = `./show.php?idp=${x.response}`;
    }
  });
}

function validarFormulario()
{
  if (input_codigo.val() == "") {
    Swal.fire({ title: "Digita un código", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }
  
  if (input_nombre.val() == "") {
    Swal.fire({ title: "Agrega un nombre...", icon: "warning", timer: 800, timerProgressBar: true });
    return false;
  }

  return true;
}
