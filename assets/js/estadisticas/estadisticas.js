$(function() {
  // google.charts.load('current', {'packages':['bar']});
  // google.charts.load("current", {packages:['corechart']});
  google.charts.load('current', {packages: ['corechart', 'bar']});

  // obj_message = new Message();
  // obj_coordinador = new Coordinador();
  // obj_coordinador.read();
});




$("#estadisticas_tipo" ).change(function() {
  $("#chart_div").empty();
  $("#contenedor1").hide();
  $("#contenedor2").hide();
  $("#title_graph_line").text("");
  $("#title_graph_line2").text("");
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
          drawChart_2(arr_datos["result_pdocente"]);
          drawChart_3(arr_datos["result_pdirector"]);
        break;


      }
    })
    .fail(function(e) {
      console.error("Error in read()"); console.table(e);
    });
  }// get_datos()

}// Estadisticas





function drawChart(arr_datos) {
  $("#contenedor1").show();
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
    $("#contenedor1").show();
  $("#contenedor2").show();
  $("#title_graph_line").text("");
  $("#title_graph_line").text("Porcentaje de evaluación preguntas docente del tipo SI, NO");
    // console.info(arr_datos);
    var datos = arr_datos["datos"];
    // datos[0] = ['Titulo', 'Requiere apoyo', {role:'annotation'}, 'En proceso', {role:'annotation'}];
    datos[0] = ['Pregunta', 'SI', "NO"];
    // console.info(datos);
    // return false;
        var data = google.visualization.arrayToDataTable(datos);
        var options = {
          width:"100%",
          height:350,
            // title: 'Porcentages de evaluacion preguntas del tipo SI, NO',
            // chartArea: {width: '50%'},
            chartArea:{ left:350,right:10,bottom:50,top:22 },
            isStacked: true,
            legend: { position: 'bottom', maxLines: 3, alignment: 'center' },
             bar: { groupWidth:20 },
            hAxis: {
              title: 'Respuestas SI, NO',
              minValue: 0,
            },
            vAxis: {
              format:'#\'%\'',
              textPosition: 'out',
              titleTextStyle: {width: 400}
            },
          };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);

    }


    function drawChart_3(arr_datos) {
      $("#title_graph_line2").text("Porcentaje de evaluación preguntas director del tipo SI, NO");
      var datos = arr_datos["datos"];
      datos[0] = ['Pregunta', 'SI', "NO"];

          var data = google.visualization.arrayToDataTable(datos);

          var options = {
            width:"100%",
            height:350,
            titlePosition: 'in',
              // title: 'Porcentages de evaluacion preguntas del tipo SI, NO DIRECTIVOS',
              chartArea:{ left:350,right:10,bottom:50,top:22 },
              isStacked: true,
              legend: { position: 'bottom', maxLines: 3, alignment: 'center' },
               bar: { groupWidth:20 },
              hAxis: {
                title: 'Respuestas SI, NO',
                minValue: 0,
              },
              vAxis: {
                format:'#\'%\'',
                textPosition: 'out',
                titleTextStyle: { color: "#d95f02",
                                  fontSize: 18,
                                  bold: true,
                                  italic: true },
              },
            };

          var chart = new google.visualization.BarChart(document.getElementById('chart_div_2'));
        chart.draw(data, options);

      }
