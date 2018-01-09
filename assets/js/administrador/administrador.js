$(function() {
  obj_message = new Message();
  obj_administrador = new Administrador();
  obj_administrador.read();
});

function Administrador(){
  that_administrador = this;
  that_administrador.idmodal = "";
  that_administrador.controlador = "Administrador";

  this.read = function(){
    var ruta = base_url+that_administrador.controlador+"/read";
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
        "grid_administrador", // el id del div HTML
        arr_columnas, // El array de columnas, serán los encabezados
        arr_datos // E array de los datos para llenar el grid, los índices deben corresponder a los nombres de las columnas
      );
      obj_grid.load();
    })
    .fail(function(e) {
      console.error("Error in read()"); console.table(e);
    });
  }// read()
}