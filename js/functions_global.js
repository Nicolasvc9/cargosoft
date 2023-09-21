$(window).on("load", function () {
  loader();
  inicio_global();
const rutaActual = window.location.pathname;
console.log("Ruta actual:", rutaActual);
if(rutaActual == "/"){
console.log("login")
}else{
validarSesion(function (resultado) {
    if (resultado) {
      // La sesion esta activa
    } else {
      return mostrarMensajeErrorSesion().then(function () {
        window.location.href = "/";
      });
    }
  });
}
  
});
$(document).ready(function () {
  let urlActual = window.location.href;

  // Cambiar la URL en la barra de navegación a "/"
  // history.pushState({}, "", "/");

  // Manejar el evento popstate para redirigir a la página original
  // window.addEventListener('beforeunload', function(event) {
  //     event.returnValue = '¿Estás seguro de que deseas abandonar la página?'; // Mostrar un mensaje personalizado
  //   });
  var sideBar = document.getElementById("mobile-nav");
  var openSidebar = document.getElementById("openSideBar");
  var closeSidebar = document.getElementById("closeSideBar");
});
let loading = $("#loader");

function loader() {
  // alert("Loading...")
  loading.fadeOut("slow");
}
function getConfig() {
  // $.post("/cargasoft/php/funciones_productos.php", {op:"getConfig"}, (x) => {
  // $.post("../controllers/ProductsController.php", {op:"getConfig"}, (x) => {
  //     console.log(x);
  // });
}

function inicio_global() {}

function validarSesion(callback) {
  console.log("Validando sesión...");
  $.post(
    "/controllers/GlobalController.php",
    { op: "validar" },
    function (data) {
      if (data.status) {
        // Llamamos al callback con true si la sesión está activa
        callback(true);
      } else {
        // Llamamos al callback con false si la sesión no está activa
        callback(false);
      }
    },
    "json"
  );
}
function mostrarMensajeErrorSesion() {
  return new Promise(function (resolve) {
    Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 1700,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    }).fire({
      icon: "error",
      title: "Error",
      text: "No hay una sesión activa.",
    });

    // Resuelve la promesa después de mostrar el mensaje de error
    setTimeout(function () {
      resolve();
    }, 1700); // 3000 milisegundos = 3 segundos
  });
}

function sidebarHandler(flag) {
  if (flag) {
    sideBar.style.transform = "translateX(0px)";
    openSidebar.classList.add("hidden");
    closeSidebar.classList.remove("hidden");
  } else {
    sideBar.style.transform = "translateX(-260px)";
    closeSidebar.classList.add("hidden");
    openSidebar.classList.remove("hidden");
  }
}
