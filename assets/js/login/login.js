    $(document).ready(function () {

    $("#form_login").validate({
            onclick:false, onfocusout: false, onkeypress:false, onkeydown:false, onkeyup:false,
            rules: {
                username: {required: true},
                clave: {required: true}
            },
            messages: {
                username: {required: "Campo requerido"},
                clave: {required: "Campo requerido"}
            }
        });

    });

   $("#btn_contacto_enviar").click(function(e){
      e.preventDefault();
      $("#form_login").submit();
   });
