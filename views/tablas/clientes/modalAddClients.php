<div class="modal fade" id="modalCliente" role="dialog" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="modalClienteLabel"><i class="fas fa-user text-secondary"></i> Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label class="w-100">
                Tipo de documento
                <select id="select_document_type" class="form-select">
                  <option value="" selected disabled>Seleccione el tipo de documento...</option>
                </select>
              </label>
            </div>
            <div class="col-12 col-md-8">
              <label class="w-100">
                Documento
                <input type="text" id="input_document" class="form-control" maxlength="15" value="">
              </label>
            </div>
            <div class="col-12 col-md-4">
              <label>
                DV
                <input type="number" id="input_dv" class="form-control" maxlength="2">
              </label>
            </div>
            
            <div class="col-12 col-md-6">
              <label>
                Primer nombre
                <input type="text" id="input_first_name" class="form-control">
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label>
                Segundo nombre
                <input type="text" id="input_second_name" class="form-control">
              </label>
            </div>
            
            <div class="col-12 col-md-6">
              <label>
                Primer apellido
                <input type="text" id="input_first_surname" class="form-control">
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label>
                Segundo apellido
                <input type="text" id="input_second_surname" class="form-control">
              </label>
            </div>

            <div class="col-12">
              <label class="w-100">
                Razón social
                <input type="text" id="input_business_name" class="form-control" value="">
              </label>
            </div>
            <div class="col-12">
              <label class="w-100">
                Dirección
                <input type="text" id="input_direction" class="form-control" value="">
              </label>
            </div>
            
            <div class="col-12 col-md-6">
              <label>
                Teléfono
                <input type="number" id="input_phone" class="form-control" value="">
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label>
                Correo
                <input type="email" id="input_email" class="form-control" value="">
              </label>
            </div>
            
            <div class="col-12 col-md-6">
              <label class="w-100">
                Ciudad
                <select id="select_idcity" class="form-select">
                  <option value="" selected disabled>Seleccione una ciudad...</option>
                </select>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="w-100">
                % seguro
                <input type="number" id="seguro" class="form-control" value="0" placeholder="ingrece eL % del seguro que manejara este cliente">
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnAccionCliente" type="button" class="btn btn-primary"></button>
        </div>
      </div>
    </div>
  </div>