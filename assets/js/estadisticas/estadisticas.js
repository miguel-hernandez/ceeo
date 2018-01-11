$(function() {
  google.charts.load('current', {'packages':['bar']});
  google.charts.load("current", {packages:['corechart']});

  // obj_message = new Message();
  // obj_coordinador = new Coordinador();
  // obj_coordinador.read();
});






function Estadisticas(){
  that_estadisticas = this;
  // that_estadisticas.idmodal = "";
  that_estadisticas.controlador = "Estadisticas";

  this.get_datos = function(tipo){
    var ruta = base_url+that_estadisticas.controlador+"/get_datos";
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
      console.log(arr_datos);
      var total = arr_datos.total;
      var tdirectores = (parseInt(arr_datos.tdirectores)*100/parseInt(total));
      var tdocentes = (parseInt(arr_datos.tdocentes)*100/parseInt(total));
      var data = google.visualization.arrayToDataTable([
        ["Questionario", "", { role: "style" }, {role:'annotation'} ],
        ["Docentes", parseInt(tdocentes), "#1b9e77", "%"],
        ["Directores", parseInt(tdirectores), "#d95f02", "%"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Porcentajes de encuestas aplicadas a docentes y directivos",
        width: "100%",
        height: 400,
        vAxis: {format: '#\'%\''},
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
      chart.draw(view, options);
  }
