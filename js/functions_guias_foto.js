$(document).ready(function () {
  imagenPreview.hide();
  btnCapturar.prop("disabled", true);
});

// Obtener referencias a los elementos del DOM
let camaraPreview = document.getElementById("camara-preview");
let cam = $("#camara-preview");
let btnActivarDesactivar = $("#btnActivarDesactivar");
let canvasFoto = document.getElementById("canvas-foto");
let ctx = canvasFoto.getContext("2d");
let camaraStream = null;
let btnCapturar = $("#btnCapturar");
let imagenPreview = $("#imagen-preview");
let btnValidarHuella = $("#btnValidarHuella");
let imagenhuella = $("#imagen-huella");
let imagenes = $("#imagenes");
let cedula1 = $("#cedula1");
let cedula2 = $("#cedula2");

// Función para activar la cámara
function activarCamara() {
  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then(function (stream) {
      camaraPreview.srcObject = stream;
      camaraStream = stream;
      cam.show();
      imagenPreview.hide();
    })
    .catch(function (error) {
      console.error("Error al acceder a la cámara: ", error);
    });
}

// Función para desactivar la cámara
function desactivarCamara() {
  if (camaraStream) {
    camaraStream.getTracks().forEach(function (track) {
      track.stop();
    });
    camaraPreview.srcObject = null;
    camaraStream = null;
  }
}

// Activar o desactivar la cámara al hacer clic en el botón
btnActivarDesactivar.click(function () {
  if (camaraStream) {
    desactivarCamara();
    btnActivarDesactivar.html('<i class="fa-solid fa-toggle-on"></i>');
    btnActivarDesactivar.toggleClass("btn_primary btn-danger");
    btnCapturar.prop("disabled", true);
  } else {
    activarCamara();
    btnActivarDesactivar.html('<i class="fa-solid fa-toggle-off"></i>');
    btnActivarDesactivar.toggleClass("btn_primary btn-danger");
    btnCapturar.prop("disabled", false);
  }
});
imagenes.change(function (e) {
  console.log("selecciono imagenes");
  e.preventDefault();
  let archivosSeleccionados = $(this)[0].files;
  console.log(archivosSeleccionados);

  if (archivosSeleccionados.length > 2) {
    alert("Solo se permiten seleccionar hasta 2 archivos.");
    imagenes.val(""); // Limpiar el campo de entrada
  } else {
    let formData = new FormData();
    formData.append("usuario", "admin");

    for (let i = 0; i < archivosSeleccionados.length; i++) {
      formData.append("imagenes[]", archivosSeleccionados[i]);
    }

    $.ajax({
      url: "/temp_data/cedulas/validar.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response);
        let data = JSON.parse(response)
        if(data.status){
            console.log("exitoso")
            cedula1.attr("src", "../../temp_data/cedulas/cedula1_admin.jpg")
            cedula2.attr("src", "../../temp_data/cedulas/cedula2_admin.jpg")

        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }
});

btnValidarHuella.click(function (e) {
  $.ajax({
    url: "/temp_data/huellas/validar.php",
    type: "POST",
    data: {
      op: "validar",
    },
    success: function (response) {
      // Manejar la respuesta del servidor
      console.log(response);
      let data = JSON.parse(response);

      if (data.status) {
        imagenhuella.attr("src", `../../temp_data/huellas/${data.user}.jpg`);
        cedula1.attr("src", `../../temp_data/cedulas/${data.user}.jpg`);
        cedula2.attr("src", `../../temp_data/cedulas/${data.user}1.jpg`);
      } else {
        imagenhuella.attr("src", "../../temp_data/huellas/invalid.jpg");
      }
    },
    error: function (xhr, status, error) {
      // Manejar errores de la solicitud AJAX
      console.error(error);
    },
  });
});

// Capturar foto al hacer clic en el botón
btnCapturar.click(function (e) {
  e.preventDefault();
  // Establecer el tamaño del canvas para que coincida con la vista previa
  canvasFoto.width = camaraPreview.videoWidth;
  canvasFoto.height = camaraPreview.videoHeight;

  // Dibujar la imagen del video en el canvas
  ctx.drawImage(camaraPreview, 0, 0, canvasFoto.width, canvasFoto.height);

  // Obtener la foto como una URL base64
  var fotoDataUrl = canvasFoto.toDataURL("image/png");

  // Enviar la foto al servidor
  $.ajax({
    url: "/temp_data/fotos/fotos.php",
    type: "POST",
    data: {
      foto: fotoDataUrl,
    },
    success: function (response) {
      // Manejar la respuesta del servidor
      console.log(response);
      let data = JSON.parse(response);
      if (data.status) {
        desactivarCamara();
        btnActivarDesactivar.html('<i class="fa-solid fa-toggle-on"></i>');
        btnActivarDesactivar.toggleClass("btn_primary btn-danger");
        btnCapturar.prop("disabled", true);
        cam.hide();
        imagenPreview.attr("src", `../../temp_data/fotos/${data.foto}`);
        imagenPreview.show();
      }
    },
    error: function (xhr, status, error) {
      // Manejar errores de la solicitud AJAX
      console.error(error);
    },
  });
});
