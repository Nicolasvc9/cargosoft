$(document).ready(function () {
  console.log("ready");
  inicio_users();
  get();
  getCiudad();
  getPermisos();
});
window.onload = function () {
  console.log("loaded");
};
let listUsers;
let modalAddUser;
let formAddUser;
let btnAddUser;
let ciudadUser;
let modalEditUser;
let formEditUser;
let usernameEdit;
let nameEdit;
let passwordEdit;
let ciudadUserEdit;
let modalAddPermisosUser;

function getCiudad() {
  $.post(
    "/controllers/CityController.php",
    { op: "getCiudades" },
    (x) => {
      console.log(x);
      html = `<option value="" selected disabled>Seleccione una ciudad</option>`;
      x.response.forEach(function (ciudad) {
        html += `<option value="${ciudad[0]}">${ciudad[2]}</option>`;
      });
      ciudadUser.html(html);
      ciudadUserEdit.html(html);
    },
    "json"
  );
}
function get() {
  $.post(
    "/controllers/UserController.php",
    { op: "get" },
    (x) => {
      console.log(x);
      if (x.status) {
        let html = `<table id="configuraciones" class="border-collapse border">
            <thead class="bg_primary text-white">
              <tr>
                <th class="border border_primary p-1">id </th>
                <th class="border border_primary p-1">nombre de usuario </th>
                <th class="border border_primary p-1">nombre </th>
                <th class="border border_primary p-1">fecha  creación </th>
                <th class="border border_primary p-1">estado </th>
                <th class="border border_primary p-1">acciones </th>
              </tr>
            </thead>
            <tbody>`;
        x.response.forEach((e) => {
          let estado = "inactivo";
          if (e[8] == "1") {
            estado = "activo";
          }
          html += `<tr>
                    <td class="border border_primary">${e[0]}</td>
                    <td class="border border_primary">${e[1]}</td>
                    <td class="border border_primary">${e[2]}</td>
                    <td class="border border_primary">${e[7]}</td>
                    <td class="border border_primary">${estado}</td>
                    <td class="border border_primary">
                      <button onclick="editUser(${e[0]})" title="Editar informacion del usuario" class="btn bt-sm bg-secondary"><i class="fa-duotone fa-user-pen"></i></button>
                      <button onclick="editPermisos(${e[0]})" title="Editar permisos del usuario" class="btn bt-sm bg-secondary"><i class="fa-duotone fa-file-pen"></i></button>
                      <button onclick="disableUser(${e[0]})" title="Deshabilitar usuario" class="btn bt-sm bg-danger"><i class="fa-duotone fa-user-xmark"></i></button>
                      <button onclick="enableUser(${e[0]})" title="Habilitar usuario" class="btn bt-sm bg-success"><i class="fa-duotone fa-user-check"></i></button>
                    </td>
                </tr>`;
        });
        html += `</tbody>
            <tfooter></tfooter>
            </table>`;
        listUsers
          .html(html)
          .promise()
          .done(function (e) {
            console.log("then");
            $("#configuraciones").DataTable();
          });
      }
    },
    "json"
  );
}
function disableUser(id) {
  $.post(
    "/controllers/UserController.php",
    { op: "statusUser", id, status: "disabled" },
    (x) => {
      console.log(x);
      console.log(x.status);
      if (x.status) {
        get();
        Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        }).fire({
          icon: "success",
          title: "Exito",
          text: x.response,
        });
      }
    },
    "json"
  );
}
function enableUser(id) {
  $.post(
    "/controllers/UserController.php",
    { op: "statusUser", id, status: "enabled" },
    (x) => {
      console.log(x);
      if (x.status) {
        get();
        Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        }).fire({
          icon: "success",
          title: "exito",
          text: x.response,
        });
      }
    },
    "json"
  );
}

function editUser(id) {
  $.post(
    "/controllers/UserController.php",
    { op: "getUsuario", id },
    (x) => {
      console.log(x);
      nameEdit.val(x.response.name);
      usernameEdit.val(x.response.user);
      ciudadUserEdit.val(x.response.ciudad);
      $("#idUserEdit").val(id);
      modalEditUser.modal("show");
    },
    "json"
  );
}
function getPermisos() {
  $.post(
    "/controllers/UserController.php",
    { op: "getPermisosAll" },
    (x) => {
      console.log(x);
      html = "<div>";

      x.response.forEach(function (permiso) {
        html += `<label>
        <input type="checkbox" class="checkPermiso" id="permiso${permiso[0]}" value="${permiso[0]}">
        ${permiso[1]} | ${permiso[2]}
      </label><br>`;
      });
      html += "<hr></div>";

      $("#bodyPermisos").html(html);
    },
    "json"
  );
}
function editPermisos(id) {
  $.post(
    "/controllers/UserController.php",
    { op: "getPermisos", id },
    (x) => {
      console.log(x);
      $("#idUserPermiso").val(id);
      $(".checkPermiso").prop("checked", false);
      if (x.response) {
        x.response.forEach(function (e) {
          // console.log(e[1]);
          let idpermiso = e[1];
          $("#permiso" + idpermiso).prop("checked", true);
        });
      }
      modalAddPermisosUser.modal("show");
    },
    "json"
  );
}

function inicio_users() {
  listUsers = $("#listUsers");
  btnAddUser = $("#btnAddUser");
  modalAddUser = $("#modalAddUser");
  formAddUser = $("#formAddUser");
  ciudadUser = $("#ciudadUser");
  modalEditUser = $("#modalEditUser");
  formEditUser = $("#formEditUser");
  usernameEdit = $("#usernameEdit");
  nameEdit = $("#nameEdit");
  passwordEdit = $("#passwordEdit");
  ciudadUserEdit = $("#ciudadUserEdit");
  modalAddPermisosUser = $("#modalAddPermisosUser");

  btnAddUser.click((x) => {
    x.preventDefault();
    modalAddUser.modal("show");
  });
  $("#btnActualizarPermisos").click(() => {
    let promises = []; // Array para almacenar las Promises de las llamadas AJAX

    $(".checkPermiso").each(function () {
      let postData = {
        op: "updatePermisos",
        permiso: $(this).val(),
        usuario: $("#idUserPermiso").val(),
        activo: $(this).prop("checked"),
      };

      let promise = new Promise((resolve, reject) => {
        $.post(
          "/controllers/UserController.php",
          postData,
          (response) => {
            // console.log(response);
            resolve(response.status);
          },
          "json"
        );
      });

      promises.push(promise);
    });

    Promise.all(promises)
      .then((results) => {
        console.log("Todas las llamadas AJAX han finalizado");
        modalAddPermisosUser.modal("hide");
        Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        }).fire({
          icon: "success",
          title: "Exito",
          text: "Permisos actualizados",
        });
        console.log("Resultados:", results);
      })
      .catch((error) => {
        console.error("Ocurrió un error:", error);
      });
  });

  formAddUser.submit(function (event) {
    event.preventDefault();
    console.log("intentando registrar usuario");
    formData = new FormData($(this)[0]);
    formData.append("op", "set");

    $.ajax({
      url: "/controllers/UserController.php",
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (x) {
        console.log(x);
        if (x.status) {
          modalAddUser.modal("hide");
          Swal.fire({
            title: "¡Exitoso!",
            text: "usuario creado corretamente",
            icon: "success",
            confirmButtonText: "Sí",
          }).then((result) => {
            if (result.isConfirmed) {
              get();
            }
          });
        } else if (x.status_detail === "existe") {
          Swal.fire({
            title: "Error",
            text: "el nombre de usuario ya existe",
            icon: "error",
            confirmButtonText: "OK",
          });
        } else {
          Swal.fire({
            title: "Error",
            text: "Se produjo un error inesperado",
            icon: "error",
            confirmButtonText: "OK",
          });
        }
      },
    });
  });
  formEditUser.submit(function (e) {
    e.preventDefault();
    if (passwordEdit.val() == "") {
      console.log("sin contraseña");
    }
    $.post(
      "/controllers/UserController.php",
      {
        op: "updateUser",
        id: $("#idUserEdit").val(),
        nombre: nameEdit.val(),
        password: passwordEdit.val(),
        ciudad: ciudadUserEdit.val(),
      },
      (x) => {
        if(x.status){
          get()
          modalEditUser.modal('hide');
          Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          }).fire({
            icon: "success",
            title: "Exito",
            text: x.status_detail,
          });
        }
      },
      "json"
    );
  });
}
