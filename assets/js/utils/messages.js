
function Message(){
  that_message = this;

  this.notification = function(title,text,type){
      swal({
        title : title,
        text : text,
        type: type,
        confirmButtonText: 'ok',
        width:'350px'
      });
  }// notification()

  this.loading = function(texto){
    swal({
        title: "<center><div class='loader'></div></center>",
        text: texto,
        width: 300,
        padding: 60,
        showCancelButton: false,
        showConfirmButton: false,
        allowEscapeKey:false,
        allowOutsideClick:false
      });
  }// loading()

}// Message
