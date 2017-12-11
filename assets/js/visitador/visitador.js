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

$("#btn_visitador_imprimir").click(function(e){
  e.preventDefault();
  var arr_row = obj_grid_rv.get_row_selected();
  var columnas = obj_grid_rv.columns;
  if(arr_row.length==0){
    obj_message.notification("","Seleccione un registro","error");
  }else{
    var rv = new Reportevisitas();
    rv.get_pdf_encuesta(arr_row[0]["id"]);
  }
});

$("#btn_visitador_editar_encuesta").click(function(e){
  e.preventDefault();
  var arr_row = obj_grid_rv.get_row_selected();
  var columnas = obj_grid_rv.columns;
  if(arr_row.length==0){
    obj_message.notification("","Seleccione un registro","error");
  }else{
    console.log(arr_row);
    $("#modal_visitador_editar_nombrect").empty();
    $("#modal_visitador_editar_nombrect").append(arr_row[0]['nombre_ct']+"("+arr_row[0]['cct']+")");
    $("#idcct").val(arr_row[0]['id']);
    console.info(arr_row[0]);
    var tipo_encuesta = (arr_row[0]['atendio'] == "DIRECTOR")? 1 : 2;
    var id_editando = arr_row[0]['id'];
    // alert("tipo_encuesta: "+tipo_encuesta);
    obj_visitador.get_cuestions(tipo_encuesta, "edita", "div_contenedor_preguntas_editar", id_editando);
    $("#modal_visitador_editar").modal("show");
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
    $("#modal_visitador_nombrect").append(arr_row[0]['nombre_ct']+"("+arr_row[0]['cct']+")");
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

  this.get_cuestions = function(tipo, operacion, contenedor, id=0){
    // alert(id);
    var html_doc = "";
    var ruta = base_url+"Visitador/get_cuestions";
    $.ajax({
      url:ruta,
      method:"POST",
      data:{"tipo": tipo, "idcct":$("#idcct").val(), "atendio":tipo, "ideditando":id},
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
      var tema1 = tema2 = tema3 = tema4 = tema5 = tema6 = false;

      html_doc="";

      html_doc+="<div class='row'>";
      html_doc+="<div class='container-fluid'>";
      html_doc+="<form action='savecuestionario' method='post' id='form_cuestionario_doc'>";
      html_doc+= "<center><label id='aviso' style='color:red;'></label></center>";
      for(var i = 0; i < arr_datos.length; i++){
        switch(arr_datos[i]['idtema']) {
            case '1':
            if(tema1 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>DATOS GENERALES</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema1 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
            case '2':
            if(tema2 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>CONOCIMIENTOS DE LOS RESULTADOS ESCOLARES PLANEA</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema2 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
            case '3':
            if(tema3 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>COMPRENCIÓN Y SOCIALIZACIÓN DE LA ESTRATEGIA ESTATAL</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema3 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
            case '4':
            if(tema4 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>ACCIONES CON MEJORES RESULTADOS</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema4 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
            case '5':
            if(tema5 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>APOYOS REQUERIDOS</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema5 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
            case '6':
            if(tema6 == false){
              html_doc+="<label class='margintop10' id='aviso' style='color:#ef6c00;'>PERFIL DE LOS DOCENTES</label>";
              html_doc+= obj_visitador.return_question(arr_datos[i]);
              tema6 = true;
            }else{
              html_doc+= obj_visitador.return_question(arr_datos[i]);
            }
                break;
        }
      }//fin for
      html_doc+="<input type='hidden' name='atendio' value="+atendio+" >";
      html_doc+="<input type='hidden' name='idcct' value="+idcct+" >";
      html_doc+="<div class='col-xs-1 pull-right margintop10'><input type='submit' value='Grabar' class='btn btn-primary'></div>";
      html_doc+="</form> ";
      html_doc+="<div>";
      html_doc+="<div>";

      $("#"+contenedor).empty();
      $("#"+contenedor).append(html_doc);
    })
    .fail(function(e) {
      console.error("Error in read()"); console.table(e);
    });
  }

  this.return_question = function(pregunta){
    var html_doc = "";

        if(pregunta['idtipopregunta'] == 1 || pregunta['idtipopregunta'] == "1"){
          html_doc += "<div class='row margintop10'>";
          html_doc +="<div class='col-xs-8'><label >"+pregunta['npregunta']+".- "+pregunta['pregunta']+"</label></div>";
          html_doc +="<div class='col-xs-2'>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea1' class='requerido' value='si' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'> SI";
          html_doc+= "</label>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea2' class='requerido' value='no' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'> NO";
          html_doc+= "</label>";
          html_doc +="</div>";
          html_doc+= "<div class='col-xs-2'><label id='label_"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"' style='color:red;'></label></div>";
          html_doc +="</div>";
        }else if(pregunta['idtipopregunta'] == 2 || pregunta['idtipopregunta'] == "2"){
          // console.log(arr_datos);
          if(pregunta['npregunta'] == '1' || pregunta['npregunta'] == 1){
            html_doc += "<div class='row margintop10'>";
            html_doc +="<div class='col-xs-12'><label>"+pregunta['npregunta']+".- "+pregunta['pregunta']+"</label></div>";
            html_doc +="<div class='col-xs-2'>";
            html_doc+= "<input class='form-control requerido' type='Number' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'>";
            // html_doc+="<textarea class='form-control requerido' rows='3' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'></textarea>";
            html_doc +="</div>";
            html_doc +="</div>";
          }else{
            html_doc += "<div class='row margintop10'>";
            html_doc +="<div class='col-xs-12'><label>"+pregunta['npregunta']+".- "+pregunta['pregunta']+"</label></div>";
            html_doc +="<div class='col-xs-12'>";
            // html_doc+= "<input class='form-control requerido' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'>";
            html_doc+="<textarea class='form-control requerido' rows='3' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'></textarea>";
            html_doc +="</div>";
            html_doc +="</div>";
          }
        }else if(pregunta['idtipopregunta'] == 3 || pregunta['idtipopregunta'] == "3"){
          html_doc += "<div class='row margintop10'>";
          html_doc +="<div class='col-xs-8'><label>"+pregunta['npregunta']+".- "+pregunta['pregunta']+"</label></div>";
          html_doc +="<div class='col-xs-2'>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea1' class='requerido' value='si' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'> SI";
          html_doc+= "</label>";
          html_doc+= "<label class='checkbox-inline'>";
          html_doc+= "<input type='radio' id='checkboxEnLinea2' class='requerido' value='no' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'> NO";
          html_doc+= "</label>";
          html_doc +="</div>";//cierra div checks
          html_doc+= "<div class='col-xs-2'><label id='label_"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"' style='color:red;'></label></div>";
          html_doc +="<div class='col-xs-12'>";
          // html_doc+= "<input class='form-control requerido' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'>";
          html_doc+="<textarea class='form-control requerido' rows='3' name='"+pregunta['idpregunta']+"-"+pregunta['idtipopregunta']+"'></textarea>";
          html_doc +="</div>";
          html_doc +="</div>";//cierra div class row
        }

      return html_doc;
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
      $("#lbl_reportevisitas_nombrect").append("Escuela: "+nombre_ct+" ("+cct+")");

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

  this.get_pdf_encuesta = function(idaplicar){
    var form = document.createElement("form");
    var element1 = document.createElement("input");

    form.name = "form_visitador_get_pdf_encuesta";
    form.id = "form_visitador_get_pdf_encuesta";
    form.method = "POST";
    form.target = "_blank";

    form.action = base_url+that_reportevisitas.controlador+"/get_pdf_encuesta";

    element1.type="hidden";
    element1.value=idaplicar;
    element1.name="idaplicar";
    form.appendChild(element1);

    document.body.appendChild(form);
    form.submit();
  }// get_pdf_encuesta()

}// Reportevisitas

$("#modal_reportevisitas_btn_cerrar").click(function(e){
  e.preventDefault();
  $("#grid_reportevisitas").empty();
  $("#modal_reportevisitas").modal("hide");
  obj_visitador.read();
});

$("#modal_visitador_btn_cerrar").click(function(e){
  e.preventDefault();
  $("#radio_director_visitador").prop('checked', false);
  $("#radio_docente_visitador").prop('checked', false);
  $("#div_contenedor_preguntas").empty();
  $("#modal_visitador").modal("hide");
  obj_visitador.read();
});

$("#modal_visitador_editar_btn_cerrar").click(function(e){
  e.preventDefault();
  $("#radio_director_visitador_editar").prop('checked', false);
  $("#radio_docente_visitador_editar").prop('checked', false);
  $("#div_contenedor_preguntas_editar").empty();
  $("#modal_visitador_editar").modal("hide");
  obj_visitador.read();
});

$('#div_contenedor_preguntas').on('submit','#form_cuestionario_doc',function(event){
  var error = 0;
  $('.requerido').each(function(i, elem){
    console.log(elem.id);
    console.log(elem.type);
    console.log(elem.name);
    if(elem.type == "radio"){
      if(!$("input[name="+elem.name+"]:checked").val()) {
        // alert("falta seleccionar");
        $('#label_'+elem.name).html('seleccione <br />');
        error++;
      }
    }else{
      if($(elem).val() == ''){
      $(elem).css({'border':'1px solid red'});
      error++;
      }
    }
    });
  if(error > 0){
    event.preventDefault();
    $('#aviso').html('Debe rellenar los campos requeridos <br />');
    }
  });
