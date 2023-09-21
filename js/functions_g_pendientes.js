$(document).ready(function() {
    inicio_guias_pendientes()
    getGuia()
})
let numGuiaPendiente
let select_idruta
let select_iddestinario
let select_idremitente
let select_idproducto
let select_idmetodopago
let input_flete
let valDeclarado
let seguroG
let valSeguro
let valEnvio
let valorTotal
let tarifaCombustible
let valorCombustible
let comercialCheckbox
let input_piezas
let input_kilos
let input_volumen
let btnEtiquetas
let numGuia
let contenido
let observaciones
let pagaRemitenteCheck
let origen
let btnGuadaCambios
let adicionales
let btnAdicionales

function getGuia(){
    $.post("/controllers/GuiasPendientesController.php", { op: "getGuiaPendiente", guia: numGuiaPendiente.val() }, (x)=>{
        console.log(x)
        if(!x.status){
            Swal.fire({
                title: x.status_detail,
                icon: "error",
                timer: 3500, timerProgressBar: true,
                willClose: () => {
                    window.location.href = "guiaPendiente.php";
                }
              });
        }
        select_idruta.val(x.response.ruta).prop('disabled', true).trigger('change')
        numGuia.val(x.response.guia).prop('disabled',true)
        select_idremitente.val(x.response.id_remitente).trigger('change')
        select_iddestinario.val(x.response.id_destinatario).trigger('change')
        if (x.response.commercial == 1) {
            comercialCheckbox.prop('checked', true).prop('disabled', true);
          } else {
            comercialCheckbox.prop('disabled', true);
          }
        contenido.val(x.response.content)
        observaciones.val(x.response.observations)
        select_idproducto.val(x.response.product).trigger('change')
        input_piezas.val(x.response.parts).prop('disabled', true)
        input_kilos.val(x.response.kg).trigger('change')
        input_volumen.val(x.response.vol).trigger('change')

        
    }, "json");
}

function inicio_guias_pendientes(){
    numGuiaPendiente = $("#numGuiaPendiente")

    select_idruta = $("#select_idruta")
    select_iddestinario = $("#select_iddestinario")
    select_idremitente = $("#select_idremitente")
    select_idproducto = $("#select_idproducto")
    select_idmetodopago = $("#select_idmetodopago")
    input_flete = $("#input_flete")
    valDeclarado = $("#valDeclarado")
    seguroG = $("#seguroG")
    valSeguro = $("#valSeguro")
    valEnvio = $("#valEnvio")
    valorTotal = $("#valorTotal")
    tarifaCombustible = $("#tarifaCombustible")
    valorCombustible = $("#valorCombustible")
    comercialCheckbox = $("#comercialCheckbox")
    input_piezas = $("#input_piezas")
    input_kilos = $("#input_kilos")
    input_volumen = $("#input_volumen")
    btnEtiquetas = $("#btnEtiquetas")
    numGuia = $("#numGuia")
    contenido = $("#contenido")
    observaciones = $("#observaciones")
    pagaRemitenteCheck = $("#pagaRemitenteCheck")
    origen = $("#origen")
    btnGuadaCambios = $("#btnGuadaCambios")
    adicionales = $("#adicionales")
    btnAdicionales = $("#btnAdicionales")

    
    select_idremitente.select2();
    select_iddestinario.select2();
    select_idproducto.select2();
    
    getRutas();
    getClientes();
    getProductos();   
    adicionales.hide()
    btnAdicionales.click(function(){
        adicionales.toggle()
    })
    seguroG.on("change keyup", function (e){
        if(valDeclarado.val() >= 1 && seguroG.val() >= 1 ){
            valSeguro.val((valDeclarado.val() * seguroG.val())/100)
        }
    });
    tarifaCombustible.blur(() =>{
        vCombustible()
    })
    select_idremitente.on('change', function(){
        $.post("/controllers/GuiasController.php", { op: "getSeguro", cliente: $(this).val() }, (x) => {
            seguroG.val(x.response.seguro).trigger('change')
        },"json")
    })
    select_idruta.change(function (e){
        $.post("/controllers/GuiasController.php", { op: "getFlete", ruta: $(this).val() }, (x) => {
            console.log(x);
            input_flete.val(x.response.flete)
            valDeclarado.val(x.response.valor_minimo_declarado)
            destino = x.response.idcity_destiny
            origen.val(x.response.idcity_origin).trigger('click')
            tarifaCombustible.val(x.response.gasolina).trigger('blur')
            valueEnvio()
        },"json")
    })
    input_kilos.on("change keyup", function (e){
        input_volumen.val(input_kilos.val())
        valueEnvio()
    });
    input_volumen.on("blur", function (){
        var volumen = parseFloat(input_volumen.val());
        var kilos = parseFloat(input_kilos.val());

        if (volumen < kilos) {
            input_volumen.val(kilos);
        }
        valueEnvio()
    });
    
}

function getRutas() {
    $.post("/controllers/GuiasController.php", { op: "getRutasP" }, (x) => {
      if (!x.status) {
          return Swal.fire({
              title: x.status_detail,
              icon: "warning",
              confirmButtonText: 'Crear ruta',
              timer: 5000, timerProgressBar: true,
              willClose: () => {
                  location.href = "../tablas/rutas";
              }
          });
      }
  
      x.response.forEach(val => {
          select_idruta.append(`<option value="${val[0]}">[${val[3]}] ${val[2]} -> [${val[6]}] ${val[5]}</option>`);
      });
    }, "json");
  }
  
  function getClientes()
  {
      $.post("/controllers/GuiasController.php", { op: "getClientes" }, (x) => {
          if (!x.status) {
              return Swal.fire({
                  title: x.status_detail,
                  icon: "warning",
                  confirmButtonText: 'Crear cliente',
                  timer: 5000, timerProgressBar: true,
                  willClose: () => {
                      location.href = "../tablas/clientes";
                  }
              });
          }
  
          if (x.response.length <= 1) {
              return Swal.fire({
                  title: "No hay suficientes clientes para generar la guía",
                  icon: "warning",
                  confirmButtonText: 'Crear cliente',
                  timer: 5000, timerProgressBar: true,
                  willClose: () => {
                      location.href = "../tablas/clientes";
                  }
              });
          }
  
          x.response.forEach(val => {
              select_iddestinario.append(`<option value="${val[0]}">[${val[3]}-${val[4]}] ${val[9]}</option>`);
              select_idremitente.append(`<option value="${val[0]}">[${val[3]}-${val[4]}] ${val[9]}</option>`);
          });
      }, "json");
  }
  
  function getProductos() {
      $.post("/controllers/GuiasController.php", { op: "getProductos" }, (x) => {
          // console.log(x);
  
        if (!x.status) {
            return Swal.fire({
                title: x.status_detail,
                icon: "warning",
                confirmButtonText: 'Crear producto',
                timer: 5000, timerProgressBar: true,
                willClose: () => {
                    location.href = "../tablas/productos";
                }
            });
        }
    
        x.response.forEach(val => {
          select_idproducto.append(`<option value="${val[0]}">[${val[1]}] ${val[2]}</option>`);
        });
      }, "json");
    }
    function vCombustible(){
        let vCombustible = (tarifaCombustible.val() > 0 && input_kilos.val() > 0) ? tarifaCombustible.val() * input_kilos.val() : 0
            valorCombustible.val(vCombustible)
    }
    function valueEnvio(){
        if(seguroG.val() > 0 && valDeclarado.val() > 0) {
            valSeguro.val(seguroG.val() * valDeclarado.val() / 100)
        }
        let kilos
        if(input_kilos.val() >= 1 || input_volumen.val() <= 1){
        kilos = (input_kilos.val() > input_volumen.val()) ? input_kilos.val() : input_volumen.val()
        let valorEnvio = (input_flete.val() * kilos)
        valEnvio.val(valorEnvio)
        }
        vCombustible()
        vTotal()
    
    }
    
    function vTotal() {
        let envio = parseInt(valEnvio.val());
        let combustible = parseInt(valorCombustible.val());
        let seguro = parseInt(valSeguro.val());
      
        if (!isNaN(envio) && !isNaN(combustible) && !isNaN(seguro)) {
          let valueTotal = envio + combustible + seguro;
          valorTotal.val(valueTotal);
        }
      }