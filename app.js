console.log('si funciona');

$(document).ready(() => {
  console.log('ready');

  //ESTO ES CON JAVASCRIPT PURO
  // document.getElementById('btn_registrar')

  //ESTO ES CON JQUERY
  //  $("#btn_registrar")

  $("#btn_registrar").on('click', (event) => {
    event.preventDefault();
    console.log('Click');

    var form = $('#form_registrar :input');

    if(typeof form === 'object'){

      //ESTO ES CON JQUERY
      var to_send = [];
      var to_send_values = new FormData();
      form.each(function(no){
        var input = $(this);
        var valor = $(this).val();
        //var valor = $(this).attr('value');
        if(typeof $(this).attr('name') !== 'undefined'){
          var nombre_input = $(this).attr('name');
          if(valor == ''){
            $(this).css({"border": "1px solid red"});
          }else{
            $(this).removeAttr('style');
            to_send.push({name: nombre_input, value: valor});
            to_send_values.append(nombre_input, valor);
            //imprimir(no);
            //console.log(no);
            //console.log(input);
            console.log("VALOR: " + valor);
            console.log("NOMBRE: " + nombre_input);
          }
        }
      });

      var no_elem = (form.length)-1;
      var no_to_send = to_send.length;
      //ENVIAR AJAX
      if(no_elem == no_to_send){
        $.ajax({
          method: "POST",
          url: "",
          data: to_send,
          success: function(content){
            console.log(content);
            $("#response").html(content);
          },
          complete: function(){
            setTimeout(function(){
              $("#response").hide('slow');
            }, 4000);
          }
        })
      }


      console.log(no_elem + "--> " + no_to_send);
      console.log(to_send);

      //ESTO ES CON JS PURO (VANILLA)
      /*
      console.log(form);
      var no_elem = form.length;
      for(var i = 0; i <= no_elem; ++i){
        console.log(i);
        console.log(typeof form[no_elem]);
      }*/

      /*
        //ARROW FUNCTION SIMPLIFICADO DE UNA LÍNEA
        arr.forEach(no => console.log(no));

        //ARROW FUNCTION
        arr.forEach((no) => {
          console.log(no)
        });

        //FUNCTION CLÁSICA
        arr.forEach(function(no){
          console.log(no)
        });
      */

      var obj = {
        "nombre": "Cristian",
        "autos": ["Ferrari", "Tesla"]
      };

      var arr = ["BMW", "Mercedes"];

    }


    /*
    console.log(typeof form);
    console.log(typeof "hola");
    console.log(typeof function(){});
    */

  });

});

//CLÁSICO
/*
function imprimir(value){
  console.log(value);
}
*/

//ES6 ECMASCRIPT
//ARROW FUNCTIONS
var imprimir = (value) => {
  console.log(value)
}
