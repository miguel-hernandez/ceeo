$(document).ready(function () {
  $('#form_catalogo_create')[0].reset();
  $("#form_catalogo_create").validate({
          onclick:false, onfocusout: false, onkeypress:false, onkeydown:false, onkeyup:false,
          rules: {
              itxt_catalogo_nombre: {required: true},
              itxt_catalogo_descripcion: {required: true}
          },
          messages: {
              itxt_catalogo_nombre: {required: " *es requerido"},
              itxt_catalogo_descripcion: {required: " *es requerido"}
          }
      });
});

$("#btn_catalogo_terminar").click(function(e){
   e.preventDefault();
   $("#form_catalogo_create").submit();
});
