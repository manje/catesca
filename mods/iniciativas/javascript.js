$( document ).ready(function() {

  tinyMCE.init({    mode : "textareas",
     menubar : false,
     theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,jqueryspellchecker",
         theme_advanced_buttons2 : "",
             theme_advanced_buttons3 : "",
                 theme_advanced_toolbar_location : "top",
                     theme_advanced_toolbar_align : "left",
                         theme_advanced_statusbar_location : "bottom",
                             theme_advanced_resizing : true
  
   });  

    //Handles menu drop down
        $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
                    });


  $('#listcategorias').change(function () {
    c=$("#listcategorias").val();
    $(".txtdeunacategoria").hide();
    $("#cat"+c).show();
  });
  
  
  $("#btnseleccionar").click(function() {
      seleccionar(idpropuesta)
  });

  $("#divnotiscol").click(function() {
    colaborar(idpropuesta);
  });

  $("#DEScolaborar").click(function() {
    colaborar(idpropuesta);
  });


});


function colaborar(id)
{
    $.ajax({
      url: "/ajax/iniciativas/colaborar/",
      data: {"id":id},
      type:  'post',
      success:  function (data) {
        if (data)
        {
          $("#diviscol").show();
          $("#divnotiscol").hide();
        }
        else
        {
          $("#diviscol").hide();
          $("#divnotiscol").show();

        }
      }
     });
}


function votar(id,voto)
{
 $.ajax({
   url: "/ajax/iniciativas/votar/",
   data: {"id":idpropuesta},
   type:  'post',
   success:  function (data) {
     $("#pro"+id+"up").css( "background-color", "" );
     $("#pro"+id+"clear").css( "background-color", "" );
     $("#pro"+id+"down").css( "background-color", "" );
     if (voto==1) $("#pro"+id+"up").css( "background-color", "#f00" );
     if (voto==3) $("#pro"+id+"down").css( "background-color", "#f00" );
     $("#pro"+id+"uptxt").html(data.up);
     $("#pro"+id+"downtxt").html(data.down);
     
   }
   
  });
}

function seleccionar(id)
{

  
  //bootbox.confirm("Are you sure?", function(result) {
  //  Example.show("Confirm result: "+result);
  //  }); 
  
  
  bootbox.dialog({
          message: "¿Está seguro que quiere convertir esta iniciativa en una propuesta en marcha?",
          title: "Confirmación",
          buttons: {
            success:
            {
              label: "SI",
              className: "btn-primary",
              callback: function() { okseleccionar(id); }
            },
            cancel: {
              label: "NO",
              className: "btn-default"
            }
          }
     });
 
 
}


function okseleccionar(id)
{

  alert(id);
}