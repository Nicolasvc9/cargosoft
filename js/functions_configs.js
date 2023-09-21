$(document).ready(function (){
    inicio_configs()
    getConfigs()
})
let listConfigs
let modalEditConfig
let formEditarConfig

function getConfigs(){
    $.post("/controllers/ConfigController.php",{op:"get"},(x)=>{
        // console.log(x);
        if(x.status){
            let html = `<table id="configuraciones" class="w-full border-collapse border border-slate-500">
            <thead class="bg_primary text_primary">
              <tr>
                <th class="border border_primary p-1">Configuración </th>
                <th class="border border_primary p-1">Atributo </th>
                <th class="border border_primary p-1">Aciones </th>
              </tr>
            </thead>
            <tbody>`
            x.response.forEach(e => {
                console.log(e);
                if(e[3] === 'color') {
                    html += `<tr class="even:bg-gray-400">
                    <td class="border border_primary">${e[1]}</td>
                    <td class="align-middle text-center">
                    <span class="d-inline-block rounded-circle" style="width: 24px; height: 24px;background-color:${e[2]} ;"></span></td>
                    <td class="border border_primary"><button onclick="EditarConfig('${e[0]}' , '${e[2]}', '${e[3]}','${e[1]}')" class="btn btn-sm btn_secondary" ><i class="fas fa-edit"></i> Editar</button></td>
                </tr>`
                }else if(e[3] === 'text' || e[3] === 'number'){
                    html += `<tr class="even:bg-gray-400">
                    <td class="border border_primary">${e[1]}</td>
                    <td class="border border_primary">${e[2]}</td>
                    <td class="border border_primary"><button onclick="EditarConfig('${e[0]}' , '${e[2]}', '${e[3]}','${e[1]}')" class="btn btn-sm btn_secondary" ><i class="fas fa-edit"></i> Editar</button></td>
                    </tr>`
                }else if(e[3] === 'file'){
                    html += `<tr class="even:bg-gray-400">
                    <td class="border border_primary">${e[1]}</td>
                    <td class="border border_primary">${e[2]}</td>
                    <td class="border border_primary"><button onclick="EditarConfig('${e[0]}' , '${e[2]}', '${e[3]}' ,'${e[1]}')" class="btn btn-sm btn_secondary" ><i class="fas fa-edit"></i> Editar</button></td>
                    </tr>`
                }
            });
            html += `</tbody>
            </table>`
            listConfigs.html(html).promise().done(function (){
                $("#configuraciones").DataTable({
                    responsive: true,
                    autoWidth: false,
                    dom: "<'top' <'row mb-3' <'col-6 text-left' B> <'col-6' f > > > <'bottom' <'row' <'col-12 mb-3' t> <'col-4' l> <'col-4' i> <'col-4' p> > >",
                    buttons: [
                      {
                        extend: 'csv',
                        text: 'CSV',
                        className: 'btn_primary'
                      },
                      {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn_primary',
                        exportOptions: {
                          columns: ':not(:last-child)',
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn_primary'
                      },
                      {
                        extend: 'print',
                        text: 'Imprimir',
                        className: 'btn_primary'
                      },{
                        extend: 'colvis',
                        text: 'Colvis',
                        className: 'btn_primary'
                      }
                    ],
                    language: {
                      search: 'Buscar', // Cambia el texto del campo de búsqueda
                      searchPlaceholder: 'Ingrese término de búsqueda', // Cambia el texto de marcador de posición del campo de búsqueda
                      lengthMenu: 'Mostrar _MENU_ registros por página', // Cambia el texto del menú desplegable de cantidad de registros por página
                      info: 'Mostrando _START_ a _END_ de _TOTAL_ registros', // Cambia el texto de información de registros mostrados
                      infoEmpty: 'Mostrando 0 registros', // Cambia el texto de información cuando no hay registros
                      infoFiltered: '(filtrados de _MAX_ registros en total)', // Cambia el texto de información cuando se aplican filtros
                      paginate: {
                        first: 'Primero', // Cambia el texto del botón "Primero"
                        last: 'Último', // Cambia el texto del botón "Último"
                        next: 'Siguiente', // Cambia el texto del botón "Siguiente"
                        previous: 'Anterior' // Cambia el texto del botón "Anterior"
                      }
                    }
              })
            })
        }
    }, "json");
}

function EditarConfig(id, value, type, name){
    let html = `<div class="form-group">
      <label for="colorInput">${name}</label>
      <div class="input-group my-colorpicker2 p-3">
      <input type="hidden" id="idConfig" name="idConfig" value="${id}">
      <input type="hidden" id="typeConfig" name="typeConfig" value="${type}">
      <input type="hidden" id="config" name="config" value="${name}">`
      if(type == "file"){
        html += `<input type="${type}" value="${value}" id="configInput" name="configInput" class="form-control" accept=".jpg,.png">`
      }else{
        html += `<input type="${type}" value="${value}" id="configInput" name="configInput" class="form-control">`
      }
      html +=`<div class="input-group-append">
          <span class="input-group-text"><i class="fa-solid fa-gear"></i></span>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-block btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-block btn-primary btn-sm">Guardar Cambios</button>
          </div>`
    formEditarConfig.html(html)
    // console.log(html)
    modalEditConfig.modal("show")
}

function inicio_configs(){
    listConfigs = $("#listConfigs")
    modalEditConfig = $("#modalEditConfig")
    formEditarConfig = $("#formEditarConfig")


    formEditarConfig.submit(function (event){
        event.preventDefault()
        formData = new FormData($(this)[0])
        formData.append('op', 'update');
        // console.log(formData)
        if ($("#typeConfig").val() === 'file') {
            if(!$('#configInput')[0].files[0]){
              return Swal.fire({
                title: "No seleccionó una imagen",
                icon: "warning",
                showCancelButton: false,
                timer: 1500,
                timerProgressBar: true
              })
            }
          let size = (($('#configInput')[0].files[0].size / 1024) / 1024)
          if (size >= 1) {
            Swal.fire({
              title: "La imagen es demasiado grande",
              text: "por favor seleccione una de menor tamaño",
              icon: "warning",
              showCancelButton: false,
              timer: 1500,
              timerProgressBar: true
            })
            return false;
          }
        }
        $.ajax({
          url: '/controllers/ConfigController.php',
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(x) {
            console.log(x);
            modalEditConfig.modal('hide')
            if(x.status){
              Swal.fire({
                title: '¡Exitoso!',
                text: 'Camibio realizado con exito',
                icon: 'success',
                confirmButtonText: 'Sí'
              }).then((result) => {
                if (result.isConfirmed) {
                  if(x.response === 'color' || x.response === 'file') {
                    location.reload();
                  }else{
                    getConfigs()
                  }
                }
              });
            }else{
              Swal.fire({
                title: 'Error',
                text: 'Se produjo un error inesperado',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          }
        });
        // let data= {}

        // var other_data = formEditarConfig.serializeArray();
        // $.each(other_data, function(val, input) {
        //   data[input.name] = input.value
        // });


        
    })
}