$(document).ready(function () {});

function resetValores(){
  valorTotal.val(0);
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(0);
      valSeguro.val(0);
      valEnvio.val(0);
      valorCombustible.val(0);
}
function productEspeciales(id) {
  resetValores()
  input_kilos.val(0)
  

  console.log(`id: ${id}`);
  html = `<div class="row">`;
  if (id == 39) {
    // si entra aca es tarifa especial perros
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="diferencialCombustible" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa kg adicional
          <input type="number" name="" id="kgAdicional" class="form-control" value="9000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="corteguia" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Perros de 1kg a 15kg
          <input type="number" name="" id="tarifaPerros" class="form-control" value="160000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="totalDiferencial" class="form-control" value="0">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total kg adicional
          <input type="number" name="" id="totalAdicional" class="form-control" value="0">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="totalFleteEsp" class="form-control border_primary" value="0">
        </label>
      </div>`;
  }
  if (id == 40) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Caja de pollos
          <select name="" id="specialtipo" class="form-select">
          <option value="1" selected>caja x 50 | $90.000</option>
            <option value="2" >caja x 100 | $150.000</option>
          </select>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0">
        </label>
      </div>`;
  }
  if (id == 41) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Minima 5 Und
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="85500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Valor unidad 6+
          <input type="number" name="" id="specialTarifaAdicional" class="form-control" value="14000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Unidades adicionales
          <input type="number" name="" id="specialTadicionales" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 42) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Cada gallo
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="100000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 43) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tipo producto
          <select class="form-select" id="specialTipo">
            <option value="1" selected>Hasta 20 Unidades $60.000</option>
            <option value="2" >de 20 hasta 40 Unidades $100.000</option>
          </select>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 44) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Unidad
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="15000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 45) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Unidad
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="13000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 46) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Unidad
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="2500000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 47) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa Unidad
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="800000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="85500" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 48) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa producto
          <select class="form-select" id="specialTarifaMin">
            <option value="1" selected>Arma vedadera $350.000</option>
            <option value="2" >Arma fogueo $250.000</option>
          </select>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="85500" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 49) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa 1-5 kg
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="171000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          kilo adicional
          <input type="number" name="" id="specialKgAdicional" class="form-control" value="8000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total kilo adicional
          <input type="number" name="" id="specialTKgAdicional" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 50) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa producto
          <select class="form-select" id="specialTarifaMin">
            <option value="1" selected>1 a 2 conejos $150.000</option>
            <option value="2" >1 gato $150.000</option>
          </select>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa animal adicional
          <input type="number" name="" id="specialKgAdicional" class="form-control" value="50000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total animal adicional 
          <input type="number" name="" id="specialTKgAdicional" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 51) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa 1 - 12 kg
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="150000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa kg adicional
          <input type="number" name="" id="specialTarifaAdicional" class="form-control" value="8500" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total kg adicional 
          <input type="number" name="" id="specialTadicionales" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 52) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Diferencial Combustible
          <input type="number" name="" id="specialdiferencial" class="form-control" value="1500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa 1 caballo
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="7500000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa mas de un caballo
          <input type="number" name="" id="specialTarifaMas" class="form-control" value="7000000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Diferencial Combustible 
          <input type="number" name="" id="specialTdiferencial" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 53) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Dif. Combustible por moto
          <input type="number" name="" id="specialdiferencial" class="form-control" value="230000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa 1 - 120 kg por moto
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="922000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa kg adicional
          <input type="number" name="" id="specialTarifaAdicional" class="form-control" value="7000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Seguro por moto
          <input type="number" name="" id="specialSeguro" class="form-control" value="20000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total kg adicional 
          <input type="number" name="" id="specialTadicionales" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  if (id == 54) {
    html += `<div class="col-12 text-center p-3"><b>Tarifa Especial</b></div>
      <div class="col-3  form-group">
        <label class="w-100">
          Dif. Combustible por moto
          <input type="number" name="" id="specialdiferencial" class="form-control" value="230000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Corte de Guia
          <input type="number" name="" id="specialcorte" class="form-control" value="5500">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa 1 - 120 kg por moto
          <input type="number" name="" id="specialTarifaMin" class="form-control" value="1080000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Tarifa kg adicional
          <input type="number" name="" id="specialTarifaAdicional" class="form-control" value="8000" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Seguro por moto
          <input type="number" name="" id="specialSeguro" class="form-control" value="50000">
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total kg adicional 
          <input type="number" name="" id="specialTadicionales" class="form-control" value="0" disabled>
        </label>
      </div>
      <div class="col-3  form-group">
        <label class="w-100">
          Total Flete Especial
          <input type="number" name="" id="specialTotal" class="form-control border_primary" value="0" disabled>
        </label>
      </div>`;
  }
  html += `</div>`;
  productosEspeciales.html(html);
  if (id == 39) {
    input_piezas.unbind();
    input_kilos.unbind();
    // establecerparametrs iniciales
    $("#diferencialCombustible").val(1500);
    $("#kgAdicional").val(9000);
    $("#corteguia").val(5500);
    $("#tarifaPerros").val(160000);
    // valor diferencial
    // total tarifas minimas
    function calcularValores() {
      if (input_kilos.val() >= 1) {
        $("#totalDiferencial").val(
          parseInt($("#diferencialCombustible").val()) *
            parseInt(input_kilos.val())
        );
      }
      if (parseInt(input_kilos.val()) > parseInt(input_piezas.val()) * 15) {
        let kgadi =
          parseInt(input_kilos.val()) - parseInt(input_piezas.val()) * 15;
        if (kgadi > 0) {
          // se pasan los kilos hay que cobrar los kilos adicionales
          $("#totalAdicional").val(kgadi * parseInt($("#kgAdicional").val()));
        } else {
          $("#totalAdicional").val(0);
        }
      }
      $("#totalFleteEsp").val(
        parseInt($("#corteguia").val()) +
          parseInt($("#totalDiferencial").val()) +
          parseInt($("#totalAdicional").val()) +
          parseInt($("#tarifaPerros").val()) * parseInt(input_piezas.val())
      );
      valorTotal.val($("#totalFleteEsp").val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(
        parseInt($("#totalAdicional").val()) +
          parseInt($("#tarifaPerros").val()) * parseInt(input_piezas.val())
      );
      valorCombustible.val($("#totalDiferencial").val());
      vTotal();
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 40) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let tipo = $("#specialtipo");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");
    let tarifa = 90000;
    let Ttarifa;

    function calcularValores() {
      Tdiferencial.val(
        parseInt(input_kilos.val()) * parseInt(diferencial.val())
      );
      if (tipo.val() == 1) {
        tarifa = 90000;
      } else {
        tarifa = 150000;
      }
      Ttarifa = parseInt(input_piezas.val()) * tarifa;
      Total.val(parseInt(Tdiferencial.val()) + parseInt(corte.val()) + Ttarifa);
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
      vTotal();
    }
    tipo.on("input", () => {
      calcularValores();
    });
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 41) {
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let TarifaAdicional = $("#specialTarifaAdicional");
    let Tdiferencial = $("#specialTdiferencial");
    let Tadicionales = $("#specialTadicionales");
    let Total = $("#specialTotal");

    function calcularValores() {
      return new Promise((resolve, reject) => {
        let numPiezas = parseInt(input_piezas.val());
        let numKilos = parseInt(input_kilos.val());

        if (numPiezas >= 1 && numKilos >= 1) {
          console.log("correcto");
        } else {
          reject("Error: Piezas y kilos deben ser mayores o iguales a 1");
        }

        Tdiferencial.val(parseInt(diferencial.val()) * numKilos);

        if (numPiezas > 5) {
          let numAdicionales = numPiezas - 5;
          Tadicionales.val(parseInt(TarifaAdicional.val()) * numAdicionales);
        } else {
          Tadicionales.val(0);
        }

        Total.val(
          parseInt(corte.val()) +
            parseInt(TarifaMin.val()) +
            parseInt(Tadicionales.val()) +
            parseInt(Tdiferencial.val())
        );

        valorTotal.val(Total.val());
        input_flete.val(0);
        valDeclarado.val(0);
        seguro.val(0);
        seguroG.val(0);
        tarifaCombustible.val(0);
        valuacion.val(4500);
        valSeguro.val(1000);
        valEnvio.val(parseInt(TarifaMin.val()) + parseInt(Tadicionales.val()));
        valorCombustible.val(Tdiferencial.val());

        resolve("Cálculos realizados con éxito");
      });
    }
    input_kilos.on("input", async () => {
      try {
        await calcularValores();
      } catch (error) {
        console.error(error);
      }
    });
    input_piezas.on("input", async () => {
      input_kilos.trigger("change");
    });
  }
  if (id == 42) {
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 43) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let tipo = $("#specialTipo");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      let tarifa;
      let Ttarifa;
      if (tipo.val() == 1) {
        tarifa = 60000;
      } else {
        tarifa = 100000;
      }
      Tdiferencial.val(
        parseInt(input_kilos.val()) * parseInt(diferencial.val())
      );
      Ttarifa = tarifa * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
    tipo.on("input", () => {
      calcularValores();
    });
  }
  if (id == 44) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(parseInt(Total.val()) + totalAdicional);
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 45) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 46) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 47) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 48) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let tarifa;
      if (TarifaMin.val() == 1) {
        tarifa = 350000;
      } else {
        tarifa = 250000;
      }
      let Ttarifa = tarifa * parseInt(input_piezas.val());

      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(Tdiferencial.val());
    }

    TarifaMin.on("input", () => {
      calcularValores();
    });
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
  }
  if (id == 49) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let KgAdicional = $("#specialKgAdicional");
    let TKgAdicional = $("#specialTKgAdicional");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let kgAdi;
      if (parseInt(input_kilos.val()) > 5) {
        kgAdi = parseInt(input_kilos.val()) - 5;
        TKgAdicional.val(kgAdi * parseInt(KgAdicional.val()));
      }
      let Ttarifa = parseInt(TarifaMin.val()) * parseInt(input_piezas.val());

      Total.val(
        Ttarifa +
          parseInt(corte.val()) +
          parseInt(Tdiferencial.val()) +
          parseInt(TKgAdicional.val())
      );
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa + parseInt(TKgAdicional.val()));
      valorCombustible.val(parseInt(Tdiferencial.val()));
    }
    input_piezas.add(input_kilos).on("input", () => {
      calcularValores();
    });

  }
  if (id == 50) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let KgAdicional = $("#specialKgAdicional");
    let TKgAdicional = $("#specialTKgAdicional");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let tarifa = 150000;
      let animal;
      if (TarifaMin.val() == 1) {
        animal = 2;
      } else {
        animal = 1;
      }
      let kgAdi = 0;
      if (parseInt(input_piezas.val()) > animal) {
        kgAdi = parseInt(input_piezas.val()) - animal;
        TKgAdicional.val(kgAdi * parseInt(KgAdicional.val()));
      } else {
        TKgAdicional.val(0);
      }

      Total.val(
        tarifa +
          parseInt(corte.val()) +
          parseInt(Tdiferencial.val()) +
          parseInt(TKgAdicional.val())
      );
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(tarifa + parseInt(TKgAdicional.val()));
      valorCombustible.val(parseInt(Tdiferencial.val()));
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });
    TarifaMin.on("input", () => {
      calcularValores();
    });
  }
  if (id == 51) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let TarifaAdicional = $("#specialTarifaAdicional");
    let Tdiferencial = $("#specialTdiferencial");
    let Tadicionales = $("#specialTadicionales");
    let Total = $("#specialTotal");

    function calcularValores() {
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );
      let kgAdicional = 0
      if (parseInt(input_kilos.val()) > 12){
        kgAdicional = parseInt(input_kilos.val()) - 12
        Tadicionales.val(kgAdicional * parseInt(TarifaAdicional.val()))
      }else{
        Tadicionales.val(0)
      }
      let Ttarifa = parseInt(Tadicionales.val()) + parseInt(TarifaMin.val())
      
      Total.val(Ttarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(Ttarifa);
      valorCombustible.val(parseInt(Tdiferencial.val()));
    }
    input_kilos.on("input", () => {
      calcularValores();
    });

  }
  if (id == 52) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let TarifaMas = $("#specialTarifaMas");
    let Tdiferencial = $("#specialTdiferencial");
    let Total = $("#specialTotal");

    function calcularValores() {
      let vTarifa;
      if (parseInt(input_piezas.val()) > 1) {
        vTarifa = parseInt(input_piezas.val()) * parseInt(TarifaMas.val());
      } else {
        vTarifa = parseInt(TarifaMin.val());
      }
      Tdiferencial.val(
        parseInt(diferencial.val()) * parseInt(input_kilos.val())
      );

      Total.val(vTarifa + parseInt(corte.val()) + parseInt(Tdiferencial.val()));
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(1000);
      valEnvio.val(vTarifa);
      valorCombustible.val(parseInt(Tdiferencial.val()));
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });

  }
  if (id == 53) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let TarifaAdicional = $("#specialTarifaAdicional");
    let Seguro = $("#specialSeguro");
    let Tadicionales = $("#specialTadicionales");
    let Total = $("#specialTotal");

    function calcularValores() {
      let TotalDif = parseInt(diferencial.val()) * parseInt(input_piezas.val());
      let TotalTarifa =
        parseInt(TarifaMin.val()) * parseInt(input_piezas.val());
      let TotalSeguro = parseInt(Seguro.val()) * parseInt(input_piezas.val());
      let kgPermitido = parseInt(input_piezas.val()) * 120;
      if (parseInt(input_kilos.val()) > kgPermitido) {
        Tadicionales.val(
          (parseInt(input_kilos.val()) - kgPermitido) *
            parseInt(TarifaAdicional.val())
        );
      } else {
        Tadicionales.val(0);
      }
      Total.val(
        TotalTarifa +
          TotalDif +
          parseInt(Tadicionales.val()) +
          parseInt(corte.val()) +
          TotalSeguro
      );
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(TotalSeguro);
      valEnvio.val(TotalTarifa + parseInt(Tadicionales.val()));
      valorCombustible.val(TotalDif);
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });

  }
  if (id == 54) {
    input_piezas.unbind();
    input_kilos.unbind();
    let diferencial = $("#specialdiferencial");
    let corte = $("#specialcorte");
    let TarifaMin = $("#specialTarifaMin");
    let TarifaAdicional = $("#specialTarifaAdicional");
    let Seguro = $("#specialSeguro");
    let Tadicionales = $("#specialTadicionales");
    let Total = $("#specialTotal");

    function calcularValores() {
      let TotalDif = parseInt(diferencial.val()) * parseInt(input_piezas.val());
      let TotalTarifa =
        parseInt(TarifaMin.val()) * parseInt(input_piezas.val());
      let TotalSeguro = parseInt(Seguro.val()) * parseInt(input_piezas.val());
      let kgPermitido = parseInt(input_piezas.val()) * 120;
      if (parseInt(input_kilos.val()) > kgPermitido) {
        Tadicionales.val(
          (parseInt(input_kilos.val()) - kgPermitido) *
            parseInt(TarifaAdicional.val())
        );
      } else {
        Tadicionales.val(0);
      }
      Total.val(
        TotalTarifa +
          TotalDif +
          parseInt(Tadicionales.val()) +
          parseInt(corte.val()) +
          TotalSeguro
      );
      valorTotal.val(Total.val());
      input_flete.val(0);
      valDeclarado.val(0);
      seguro.val(0);
      seguroG.val(0);
      tarifaCombustible.val(0);
      valuacion.val(4500);
      valSeguro.val(TotalSeguro);
      valEnvio.val(TotalTarifa + parseInt(Tadicionales.val()));
      valorCombustible.val(TotalDif);
    }
    input_piezas.on("input", () => {
      calcularValores();
    });
    input_kilos.on("input", () => {
      calcularValores();
    });

  }

  productosEspeciales.show();
  input_piezas.on("change keyup", function (e) {
    btnEtiquetas.prop("disabled", false);
  });
  input_kilos.on("change keyup", function (e) {
    input_volumen.val(input_kilos.val());
    // select_idproducto.trigger("change");
    if (select_idproducto.val() <= 38) {
      valueEnvio();
    }
  });
}
