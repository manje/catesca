


$( document ).ready(function() {

  $("#botonadd").click(function () 
  {
    $("#botonadd").hide();
    $("#formadd").show();
  });
  
  $("#botoncancelar").click(function () 
  {
    $("#botonadd").show();
    $("#formadd").hide();
  });
  
  $("#mecanica").change(function ()
  {
    if
    (
       ($("#mecanica").val()=="varias")
       ||
       ($("#mecanica").val()=="preferente")
    )
      $("#minymax").show();
    else
      $("#minymax").hide();
  
  });

  if ($("#mecanica").val()>1)
     $("#minymax").show();
  else
     $("#minymax").hide();

  $("#papeleta").sortable();
  

  $("#escrutinio").change(function ()
  {
    if($("#escrutinio").val()=="vut")
      $("#divtipovut").show();
    else
      $("#divtipovut").hide();
  });
  $("#tipovut").change(function ()
  {
    if($("#tipovut").val()=="numero")
      $("#divnumvut").show();
    else
      $("#divnumvut").hide();
  });
  
  




  if (typeof maxopciones != 'undefined')
  {
     for (var i=0; i<voto.length; i++) { selop(voto[i]); }
  }

});


function selop(op)
{
  if ($("#papeleta li").length <  maxopciones )
  {
    if (!($("#papeleta_"+op).length))
    {          
      opcion=opciones[op]
      $("#opcion"+op).hide();
      $("#papeleta").append("<li class=opcion id=papeleta_"+op+">"+opcion.titulo+" <span onclick='desdelop(\""+op+"\");' class='glyphicon glyphicon-trash'> </span> </li>");
    }
  }
}

function desdelop(op)
{
  $("#papeleta_"+op).hide();
  $("#papeleta_"+op).remove();
  $("#opcion"+op).show();
  
}

function guardarpapeleta()
{
  var con=[]
  $('#papeleta li').each(function(indice, elemento) {
      con.push($(elemento).attr('id'));
  });
  
  $.ajax({   
     url: "/ajax/votacion/contestarpregunta/",
     data: {"voto":JSON.stringify(con),"votacion":idvotacion,"pregunta":idpregunta},
     type:  'post',   
     success:  function (data) {   
       document.location.href='/votacion/'+idvotacion+'/votar/';
     }
  });
                                                       
  

            

}