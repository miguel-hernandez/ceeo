$(function() {
  obj_message = new Message();
  obj_coordinador = new Coordinador();
  obj_coordinador.read();
});


$("#btn_coordinador_mostrar").click(function(e){
  e.preventDefault();
  var arr_row = obj_grid.get_row_selected();
  var columnas = obj_grid.columns;
  if(arr_row.length==0){
    obj_message.notification("","Seleccione un registro","error");
  }else{
    // alert("id visitador: "+arr_row[0]["id"]);

    $("#itxt_coordinador_id_visitador").val(arr_row[0]["id"]);
    // return false;
    $("#form_coordinador_mostrar").submit();
    /*
    if(arr_row[0]["nvisitas"] == 0){
      obj_message.notification("","La CCT aún no tiene visitas","error");
    }else{
      var rv = new Reportevisitas();
      rv.read(arr_row[0]);
    }
    */
  }
});


$("#btn_coordinador_estadisticas").click(function(e){
  e.preventDefault();
  var arr_row = obj_grid.get_row_selected();
  var columnas = obj_grid.columns;
  if(arr_row.length==0){
    obj_message.notification("","Seleccione un registro","error");
  }else{
    alert("id visitador: "+arr_row[0]["id"]);
  }
});


$("#idmodal").click(function(e){
  e.preventDefault();
  $("#idmodal").modal("hide");
  $('#idform')[0].reset();
});


function Coordinador(){
  that_coordinador = this;
  that_coordinador.idmodal = "";
  that_coordinador.controlador = "Coordinador";

  this.read = function(){
    var ruta = base_url+that_coordinador.controlador+"/read";
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
        "grid_coordinador", // el id del div HTML
        arr_columnas, // El array de columnas, serán los encabezados
        arr_datos // E array de los datos para llenar el grid, los índices deben corresponder a los nombres de las columnas
      );
      obj_grid.load();
    })
    .fail(function(e) {
      console.error("Error in read()"); console.table(e);
    });
  }// read()

}// Coordinador
