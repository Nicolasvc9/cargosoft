$(document).ready(function () {
  inicio_login();
});
let formLogin;
function limpiarCaracteresEspeciales(texto) {
  let caracteresEspeciales = {
    á: "a",
    é: "e",
    í: "i",
    ó: "o",
    ú: "u",
    ñ: "n",
    Á: "A",
    É: "E",
    Í: "I",
    Ó: "O",
    Ú: "U",
    Ñ: "N",
    " ": "_",
    ".": "_",
    ",": "_",
    ";": "_",
    ":": "_",
    "-": "_",
    _: "_",
    "*": "_",
    "&": "_",
    "%": "_",
    $: "_",
    "#": "_",
    "@": "_",
    "!": "_",
    "¡": "_",
    "?": "_",
    "¿": "_",
    "=": "_",
    "+": "_",
    '"': "_",
    "<": "_",
    ">": "_",
    "|": "_",
    "\\": "_",
    "/": "_",
    "°": "_",
    º: "_",
    ª: "_",
    "&": "_",
    "¬": "_",
    "{": "_",
    "}": "_",
    "[": "_",
    "]": "_",
    "^": "_",
    "~": "_",
    "`": "_",
    "´": "_",
    "¨": "_",
    "¸": "_",
    "¿": "_",
    "¡": "_",
    "¦": "_",
    "¢": "_",
    "£": "_",
    "¥": "_",
    "§": "_",
    ª: "_",
    "®": "_",
    "©": "_",
    "™": "_",
    µ: "_",
    "¶": "_",
    "·": "_",
    "¹": "_",
    "²": "_",
    "³": "_",
    "´": "_",
    µ: "_",
    "¶": "_",
    "·": "_",
    "¹": "_",
    "²": "_",
    "³": "_",
    "´": "_",
    "'": "_",
    µ: "_",
    "¶": "_",
    "·": "_",
    "¹": "_",
    "²": "_",
    "³": "_",
    "´": "_",
    µ: "_",
    "¶": "_",
    "·": "_",
  };
  for (let i in caracteresEspeciales) {
    texto = texto.replace(i, caracteresEspeciales[i]);
  }
  return texto;
}
function login() {
  let user = $("#user").val();
  let password = $("#password").val();

  // console.log(user);
  // console.log(password);

  if (user === "" || password === "") {
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
      icon: "error",
      title: "Error",
      text: "Debe completar todos los campos",
    });
  } else {
    let data = {
      op: "login",
      user: user,
      password: password,
    };
    $.ajax({
      url: "/controllers/LoginController.php",
      type: "POST",
      data: data,
      success: function (data) {
        console.log(data);
        data = JSON.parse(data);
        console.log(data);
        if (data.status) {
          window.location.href = "./views/";
        } else {
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
            icon: "error",
            title: "Error",
            text: data.response,
          });
        }
        console.log("no cargo");
      },
    });
  }
}

function inicio_login() {
  formLogin = $("#formLogin");
  formLogin.submit(function (e) {
    e.preventDefault();
    login();
  });
}
