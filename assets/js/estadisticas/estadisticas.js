$(function() {
  google.charts.load('current', {'packages':['bar']});


  // obj_message = new Message();
  // obj_coordinador = new Coordinador();
  // obj_coordinador.read();
});






function Estadisticas(){
  that_estadisticas = this;
  // that_estadisticas.idmodal = "";
  that_estadisticas.controlador = "Estadisticas";

  this.get_datos = function(tipo){
    var ruta = base_url+that_estadisticas.controlador+"/get_xatendio";
    $.ajax({
      async: true,
      url: ruta,
      method: 'POST',
      data: {"tipo":tipo},
      beforeSend: function( xhr ) {
        obj_message.loading("Descargando datos");
      }
    })
    .done(function( data ) {
      swal.close();
      var arr_datos = data.result;
      console.info(arr_datos);
      drawChart(arr_datos);

      // var arr_columnas = data.columnas;
      // obj_grid = new Grid(
      //   "grid_coordinador", // el id del div HTML
      //   arr_columnas, // El array de columnas, serán los encabezados
      //   arr_datos // E array de los datos para llenar el grid, los índices deben corresponder a los nombres de las columnas
      // );
      // obj_grid.load();
    })
    .fail(function(e) {
      console.error("Error in read()"); console.table(e);
    });
  }// get_datos()

}// Estadisticas



function drawChart(arr_datos) {
var total = arr_datos.total;
var tdirectores = arr_datos.tdirectores;
var tdocentes = arr_datos.tdocentes;

  var data = google.visualization.arrayToDataTable([
    [total+' ', 'Docentes', 'Directores'],
    ['', tdocentes, tdirectores]
  ]);

  var options = {
    chart: {
      title: 'Encuestas aplicadas',
      subtitle: ""
    },
    bars: 'vertical',
    vAxis: {format: 'decimal'},
    height: 400,
    colors: ['#1b9e77', '#d95f02', '#7570b3']
  };

  var chart = new google.charts.Bar(document.getElementById('chart_div'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
