$(function() {
  obj_message = new Message();
  obj_visitador = new Visitador();
  obj_visitador.read();
});



$("#btn_visitador_mostrar").click(function(e){
    e.preventDefault();
    var arr_row = obj_grid.get_row_selected();
    var columnas = obj_grid.columns;
    if(arr_row.length==0){
        obj_message.notification("","Seleccione un registro","error");
    }else{
      console.info(arr_row[0]);
    }
});

$("#modal_catalogo_btn_cerrar").click(function(e){
    e.preventDefault();
    $("#"+obj_catalogo.idmodal).modal("hide");
    $('#form_catalogo_create')[0].reset();
});


function Visitador(){
    that_visitador = this;
    that_visitador.idmodal = "";
    that_visitador.controlador = "Visitador";

    this.read = function(){
          var ruta = base_url+that_visitador.controlador+"/read";
          $.ajax({
            async: true,
            url: ruta,
            method: 'POST',
            data: {},
            beforeSend: function( xhr ) {
              obj_message.loading("Descargando datos");
            }
          })
          .done(function( data ) {
            swal.close();
            var arr_datos = data.result;
            var arr_columnas = data.columnas;
            obj_grid = new Grid(
                "grid_visitador", // el id del div HTML
                arr_columnas, // El array de columnas, serán los encabezados
                arr_datos // E array de los datos para llenar el grid, los índices deben corresponder a los nombres de las columnas
            );
            obj_grid.load();
          })
          .fail(function(e) {
            console.error("Error in read()"); console.table(e);
          });
    }// read()


}// Visitador
