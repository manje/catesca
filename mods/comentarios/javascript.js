function enviarcomentario(mod,ele,padre)
{
  $("#poner-"+ele+"-"+padre).hide(100);
  tinyMCE.triggerSave();
  var txt=$("#com-"+ele+"-"+padre).val();
  $("#form-"+ele+"-"+padre).html('<img src="/img/ajax-loader.gif">');
  $.ajax({
    url: "/ajax/comentarios/add/",
    data: {"cmod":mod,"cele":ele,"padre":padre,"txt":txt },
    type:  'post',
    success:  function (data) {
      if (data)
      {
        $("#txt-"+ele+"-"+padre).html(   txt   );
        $("#form-"+ele+"-"+padre).hide();
        $("#cnew-"+ele+"-"+padre).show(100);
      }
  
    }
 });
 
}