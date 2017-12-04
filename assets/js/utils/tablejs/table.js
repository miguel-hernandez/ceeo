function Grid(iddiv,columnas,arr_datos){
  obj_grid = this;

  obj_grid.iddiv = iddiv;
  obj_grid.columns = columnas;
  obj_grid.arr_datos = arr_datos;

  obj_grid.html  = "";
  obj_grid.arr_row_selected = [];

  this.load = function(){
    var html="";
    obj_grid.init();

    html += "<div class='table-responsive'>";
    html += "<table id='idtable' class='table table-condensed table-hover  table-bordered'>";
    html += "<thead class='table_head'>";
    html += "<tr>";
      for (var i = 0; i<obj_grid.columns.length; i++) {
        if(obj_grid.columns[i]=="id"){
          html += "<td id='"+obj_grid.columns[i]+"' hidden>";
          html += obj_grid.columns[i];
          html += "</td>";
        }
        else{
            html += "<td id='"+obj_grid.columns[i]+"'>";
            html += obj_grid.columns[i];
            html += "</td>";
          }
      }
    html += "</tr>";
    html += "</thead>";

    html += "<tbody>";

    if(obj_grid.arr_datos.length > 0){
      for (var i = 0; i<obj_grid.arr_datos.length; i++) {
        html += "<tr>";
        for (var j=0; j<obj_grid.columns.length; j++) {
          if(obj_grid.columns[j]=="id"){
            // console.info(obj_grid.columns);
            html += "<td id='"+obj_grid.columns[j]+"' data='"+obj_grid.arr_datos[i][obj_grid.columns[j]]+"' hidden>";
            html += obj_grid.arr_datos[i][obj_grid.columns[j]];
            html += "</td>";
          }
          else{
            html += "<td id='"+obj_grid.columns[j]+"' data='"+obj_grid.arr_datos[i][obj_grid.columns[j]]+"'>";
            html += obj_grid.arr_datos[i][obj_grid.columns[j]];
            html += "</td>";
          }

        }
        html += "</tr>";
      }
    }
    else{
      html += "<tr>";
      html += "<td colspan='"+obj_grid.columns.length+"'>No hay datos para mostrar</td>";
      html += "</tr>";
    }

    html += "</tbody>";
    html += "</table>";
    html += "</div>";

    obj_grid.html = html;

    obj_grid.finish();

  }// load()

  this.finish = function(){
    $("#"+obj_grid.iddiv).empty();
    $("#"+obj_grid.iddiv).append(obj_grid.html);
  }// load()

  this.get_row_selected = function(){
    return obj_grid.arr_row_selected;
  }// get_row_selected()

  $(document).on("click", "#"+obj_grid.iddiv+" tbody tr", function(e) {
    obj_grid.init();
    // $(this).css( {"background-color": "#CEF6CE", "font-size": "16px"} );
    $(this).css( {"background-color": "#D0EDF2", "font-size": "15px"} );

    var arr_aux = [];
    $(this).children("td").each(function (){
      arr_aux[this.id] = $(this).attr('data');
      // obj_grid.arr_row_selected[this.id] = $(this).attr('data');
    });
    obj_grid.arr_row_selected[0] = arr_aux;
  });

  this.init  = function(){
    $("#"+obj_grid.iddiv+ " tbody tr").each(function () {
      $(this).css( {"background-color": "white", "font-size": "14px"} );
    });
  }// init()

}// Grid
