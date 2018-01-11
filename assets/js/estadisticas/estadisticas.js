$(function() {
  google.charts.load('current', {'packages':['bar']});
  google.charts.load("current", {packages:['corechart']});

  // obj_message = new Message();
  // obj_coordinador = new Coordinador();
  // obj_coordinador.read();
});




$("#estadisticas_tipo" ).change(function() {
  $("#chart_div").empty();
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
      switch (tipo) {
        case "1":
          drawChart(arr_datos);
        break;
        case "2":
          drawChart_2(arr_datos);
        break;


      }
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

  function drawChart_2(arr_datos) {
    // console.info(arr_datos);
    var datos = arr_datos["datos"];
    // datos[0] = ['Titulo', 'Requiere apoyo', {role:'annotation'}, 'En proceso', {role:'annotation'}];
    datos[0] = ['Pregunta', 'SI', "NO"];
    // console.info(datos);
    // return false;

      // var tdocentes = (parseInt(arr_datos.tdocentes)*100/parseInt(arr_datos["totalaplicadas"]));

        var data = google.visualization.arrayToDataTable(datos);
        var options = {
          width:"100%",
          height:350,
          legend:{  position:'bottom'},
          bar: { groupWidth:'50%' },
          isStacked:true,
          colors:['#5FB404', '#FAAC58'],

          // title:title_chart,
          titleTextStyle:{
            color:'#073F7F',
            fontSize:18
          },
          vAxis:{
            format:'#\'%\''
          },
          chartArea:{ left:50,right:50,bottom:50,top:22 }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);

    }
