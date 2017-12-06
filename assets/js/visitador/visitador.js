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
      if(arr_row[0]["nvisitas"] == 0){
        obj_message.notification("","La CCT aún no tiene visitas","error");
      }else{
        var rv = new Reportevisitas();
        rv.read(arr_row[0]);
      }
    }
});

$("#btn_visitador_registrar").click(function(e){
    e.preventDefault();
    var arr_row = obj_grid.get_row_selected();
    var columnas = obj_grid.columns;
    if(arr_row.length==0){
        obj_message.notification("","Seleccione un registro","error");
    }else{
        $("#modal_visitador .modal-body").empty();
        html="";
        html+="<div class='container-fluid'>";
          html+="<div class='col-xs-12'><label>Escuela "+arr_row[0]['nombre_ct']+"</label></div>";
          html+="<div class='col-xs-12'><label>Seleccione una seleccion de cuestionario</label></div>";
          html+="<label class='checkbox-inline'>";
            html+="<input type='radio' name='opciones' id='radio_director_visitador' onclick='obj_visitador.get_cuestions(1);' value='opcion_1'> Director";
          html+="</label>";
          html+="<label class='checkbox-inline'>";
            html+="<input type='radio' name='opciones' id='radio_docente_visitador' onclick='obj_visitador.get_cuestions(2);' value='opcion_2'> Docente";
          html+="</label>";
        html+="</div>";
        html+="<div id= 'div_contenedor_preguntas'></div>";
        $("#modal_visitador .modal-body").append(html);
        $("#modal_visitador").modal("show");
      console.info(arr_row[0]);
    }
});

$("#radio_docente_visitador").change(function(event) {
  /* Act on the event */
  e.preventDefault();
    obj_visitador = new Visitador();
  obj_visitador.get_cuestions("docente");
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


            $("#visitador_asignadas").empty();
            $("#visitador_asignadas").append(data.asignadas);
            $("#visitador_visitadas").empty();
            $("#visitador_visitadas").append(data.visitadas);
            $("#visitador_sinvisitar").empty();
            $("#visitador_sinvisitar").append(data.sin_visitar);
            $("#visitador_tvisitadas").empty();
            $("#visitador_tvisitadas").append(data.total_visitas);

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

    this.get_cuestions = function(tipo){
      $("#modal_visitador").modal("hide");
       var html_doc = "";
      var ruta = base_url+"Visitador/get_cuestions";
      $.ajax({
        url:ruta,
        method:"POST",
        data:"tipo="+tipo,
        beforeSend: function( xhr ) {
          // $("#modal_visitador .modal-body").empty();
              obj_message.loading("Descargando datos");
            }
          })
          .done(function( data ) {
            swal.close();
            var arr_datos = data.result;
            console.table(arr_datos);

            
        html_doc="";
        html_doc+="<div class='container-fluid'>";
        html_doc+="form action='action_page.php'";
        html_doc+="<div id= 'div_contenedor_preguntas'>";
           
            for(var i = 0; i < arr_datos.length; i++){
              if(arr_datos[i]['idtipopregunta'] == 1 || arr_datos[i]['idtipopregunta'] == "1"){
                html_doc +="<div class='col-xs-8'><label>"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
                html_doc +="<div class='col-xs-8'>";
                html_doc+= "<label class='checkbox-inline'>";
                  html_doc+= "<input type='checkbox' id='checkboxEnLinea1' value='opcion_1'> SI";
                html_doc+= "</label>";
                html_doc+= "<label class='checkbox-inline'>";
                  html_doc+= "<input type='checkbox' id='checkboxEnLinea2' value='opcion_2'> NO";
                html_doc+= "</label>";
                html_doc +="</div>";
              }else if(arr_datos[i]['idtipopregunta'] == 2 || arr_datos[i]['idtipopregunta'] == "2"){
                html_doc +="<div class='col-xs-8'><label>"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
                html_doc +="<div class='col-xs-8'>";
                html_doc+= "<input >";
                html_doc +="</div>";
              }else if(arr_datos[i]['idtipopregunta'] == 3 || arr_datos[i]['idtipopregunta'] == "3"){
                 html_doc +="<div class='col-xs-8'><label>"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
                html_doc +="<div class='col-xs-8'>";
                html_doc+= "<label class='checkbox-inline'>";
                  html_doc+= "<input type='checkbox' id='checkboxEnLinea1' value='opcion_1'> SI";
                html_doc+= "</label>";
                html_doc+= "<label class='checkbox-inline'>";
                  html_doc+= "<input type='checkbox' id='checkboxEnLinea2' value='opcion_2'> NO";
                html_doc+= "</label>";
                html_doc +="</div>";
                html_doc +="<div class='col-xs-8'>";
                html_doc+= "<input >";
                html_doc +="</div>";
              }
              console.log(arr_datos[i]);
            }
            html_doc+="</form> ";
            html_doc+="</div>";
            $("#div_contenedor_preguntas").empty();
            $("#modal_visitador .modal-body").append(html_doc);
            $("#modal_visitador").modal("show");
          })
          .fail(function(e) {
            console.error("Error in read()"); console.table(e);
          });
    }


}// Visitador


function Reportevisitas(){
    that_reportevisitas = this;
    that_reportevisitas.idmodal = "";
    that_reportevisitas.controlador = "Visitador";

    this.read = function(arr_cct){
      var idcct = arr_cct["id"];
      var cct = arr_cct["cct"];
      var nombre_ct = arr_cct["nombre_ct"];
      var turno = arr_cct["turno"];

      console.info("Reportevisitas -> read() idcct");
          console.info(idcct);
          var ruta = base_url+that_reportevisitas.controlador+"/reportevisitas";
          $.ajax({
            async: true,
            url: ruta,
            method: 'POST',
            data: {"idcct":idcct},
            beforeSend: function( xhr ) {
              obj_message.loading("Descargando datos");
            }
          })
          .done(function( data ) {
            swal.close();
            $("#lbl_reportevisitas_nombrect").empty();
            $("#lbl_reportevisitas_nombrect").append("Escuela: "+nombre_ct+" ("+cct+" / "+turno+")");

            var arr_datos = data.result;
            var arr_columnas = data.columnas;
            obj_grid_rv = new Grid(
                "grid_reportevisitas", // el id del div HTML
                arr_columnas, // El array de columnas, serán los encabezados
                arr_datos // E array de los datos para llenar el grid, los índices deben corresponder a los nombres de las columnas
            );
            obj_grid_rv.load();
            $("#modal_reportevisitas").modal("show");
          })
          .fail(function(e) {
            console.error("Error in read()"); console.table(e);
          });
    }// read()

}// Reportevisitas

$("#modal_reportevisitas_btn_cerrar").click(function(e){
    e.preventDefault();
    $("#grid_reportevisitas").empty();
    $("#modal_reportevisitas").modal("hide");
    obj_visitador.read();
});
