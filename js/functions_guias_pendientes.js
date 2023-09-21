$(document).ready(function() {
    inicio_guias_pendientes()
    getGuiasPendientes()
})
let lista_guias_pendientes

function getGuiasPendientes(){
    $.post("/controllers/GuiasPendientesController.php", { op: "getGuiasPendientes" }, (x)=>{
        console.log(x);
        if (!x.response) {
            return lista_guias_pendientes.html(`No hay Guias Pendientes.`);
          }
        
          if ($.fn.DataTable.isDataTable('#lista_guias_pendientes')) {
            table.destroy();
          }
        let data = [];
        x.response.forEach(val => {
            data.push({
                "numero": val[0],
                "remitente": val[1],
                "acciones": `
                <a href="index.php?guia=${val[2]}" class="btn btn-sm bg_primary text_primary"><i class="fas fa-pen"></i></a>
                `,
            });
        });

        lista_guias_pendientes.DataTable({
            data: data,
            columns: [
            { data: 'numero' },
            { data: 'remitente' },
            { data: 'acciones' }
            ]
        });
    }, "json");
}

function inicio_guias_pendientes(){
    lista_guias_pendientes = $("#lista_guias_pendientes")


    
}