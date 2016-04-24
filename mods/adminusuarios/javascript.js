function eliminarusu(idu,modulo,elemento)
{
  idaeliminar=idu;
  $('#form-eliminar').modal('show');

}

$("#eliminarusuboton").click( function () 
{

            $.ajax({
                url: "/ajax/adminusuarios/eliminarusu/",
                data: {"idu":idaeliminar,"idm":modulo,"ide":elemento},
                type:  'post',
                success:  function (data) {

                   document.location.reload(true);
                   
                   

                }
                
                
            });
           
});




$( document ).ready(function() {

  $("#anadirusu").click(function () 
  {

       $.ajax({
           url: "/ajax/adminusuarios/anadirusu/",
           data: {"emailu":$("#emailanadir").val(),"rol":$("#rol").val(),"idm":modulo,"ide":elemento},
           type:  'post',
           success:  function (data) {
  
              document.location.reload(true);
  
  
           }
       });
  
  });
  

$("#eliminarusuboton").click( function () 
{

            $.ajax({
                url: "/ajax/adminusuarios/eliminarusu/",
                data: {"idu":idaeliminar,"idm":modulo,"ide":elemento},
                type:  'post',
                success:  function (data) {

                   document.location.reload(true);
                   
                   

                }
                
                
            });
           
});





});