$(function() {
  $.validator.addMethod("valueNotEquals", function(value, element, arg){
       return arg !== value;
    });

    $("#form_recepcion").validate({
        onclick:false, onfocusout: false, onkeypress:false, onkeydown:false, onkeyup:false,
        rules: {
            autor_libro: {required: true},
            n_solicitante: {required: true},
            p_solicitante: {required: true},
            a_solicitante: {required: true},
            titulo_academico: { valueNotEquals: "0" },
            dependencia: {required: true},
            departamento: {required: true},
            puesto: {required: true, minlength: 5},
            n_oficio: {required: true},
            solicitud: {required: true},
            observaciones: {required: true}
        },
        messages: {
            autor_libro: {required: " *Seleccione un autor"},
            n_solicitante: {required: " *es requerido"},
            p_solicitante: {required: " *es requerido"},
            a_solicitante: {required: " *es requerido"},
            titulo_academico: { valueNotEquals: "Seleccione una opción" },
            dependencia: { required: " *es requerido" },
            departamento: { required: " *es requerido" },
            puesto: { required: " *es requerido", minlength: "*almenos 5 caracteres" },
            n_oficio: {required: "*es requerido"},
            solicitud: {required: "*es requerido"},
            observaciones: {required: "*es requerido"}
        }
    });
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
    $("#modal_visitador_nombrect").empty();
    $("#modal_visitador_nombrect").append(arr_row[0]['nombre_ct']);
    $("#idcct").val(arr_row[0]['id']);
    // $("#modal_visitador .modal-body").append(html);
    $("#modal_visitador").modal("show");
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
    var html_doc = "";
    var ruta = base_url+"Visitador/get_cuestions";
    $.ajax({
      url:ruta,
      method:"POST",
      data:{"tipo": tipo, "idcct":$("#idcct").val(), "atendio":tipo},
      beforeSend: function( xhr ) {
        obj_message.loading("Descargando datos");
      }
    })
    .done(function( data ) {
      swal.close();
      var idcct = data.idcct;
      var atendio = data.atendio;
      var arr_datos = data.result;
      console.table(arr_datos);


      html_doc="";

      html_doc+="<div class='row'>";
      html_doc+="<form action='savecuestionario' method='post' id='form_cuestionario_doc'>";
      for(var i = 0; i < arr_datos.length; i++){
        if(arr_datos[i]['idtipopregunta'] == 1 || arr_datos[i]['idtipopregunta'] == "1"){
          html_doc +="<div class='col-xs-8'><label >"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
          html_doc +="<div class='col-xs-8'>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea1' value='si' name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'> SI";
          html_doc+= "</label>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea2' value='no' name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'> NO";
          html_doc+= "</label>";
          html_doc +="</div>";
        }else if(arr_datos[i]['idtipopregunta'] == 2 || arr_datos[i]['idtipopregunta'] == "2"){
          html_doc +="<div class='col-xs-8'><label>"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
          html_doc +="<div class='col-xs-8'>";
          html_doc+= "<input name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'>";
          html_doc +="</div>";
        }else if(arr_datos[i]['idtipopregunta'] == 3 || arr_datos[i]['idtipopregunta'] == "3"){
          html_doc +="<div class='col-xs-8'><label>"+arr_datos[i]['npregunta']+".- "+arr_datos[i]['pregunta']+"</label></div>";
          html_doc +="<div class='col-xs-8'>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea1' value='si' name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'> SI";
          html_doc+= "</label>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea2' value='no' name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'> NO";
          html_doc+= "</label>";
          html_doc +="</div>";
          html_doc +="<div class='col-xs-8'>";
          html_doc+= "<input name='"+arr_datos[i]['idpregunta']+"-"+arr_datos[i]['idtipopregunta']+"'>";
          html_doc +="</div>";
        }
        console.log(arr_datos[i]);
      }
      html_doc+="<input type='hidden' name='atendio' value="+atendio+" >";
      html_doc+="<input type='hidden' name='idcct' value="+idcct+" >";
      html_doc+="<div class='col-xs-2'><input type='submit' value='Grabar' class='btn btn-primary'></div>";
      html_doc+="</form> ";
      html_doc+="<div>";

      $("#div_contenedor_preguntas").empty();
      $("#div_contenedor_preguntas").append(html_doc);
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
