$(document).ready(function() {
    inicio_global()
})

function getDatos(){
    datos = {
        nombre: "diego",
        apellidos: "rangel"
    }
    $.post("/controllers/stickers.php", {op:"getDatos", datos}, (x) => {
        console.log(x);
    })
}

function inicio_global(){
    getDatos()
    console.log("estoy en la funcion inicio...");
}