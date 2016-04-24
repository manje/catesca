<div class=container>

<h1>Crear Herramienta de Participación</h1>


{if $creada}


{if $redireccion}

  <div class="alert alert-danger" role="alert">
  <strong>Herramienta creada</strong>
  Redireccionando a configuración de herramienta...
  <SCRIPT>
      window.location.href="{$redireccion}";
  </SCRIPT>


{else}
  Herramienta creada, id {$creada->id}




</div>




{/if}

{else}


{if $errores}
  <div class="alert alert-danger" role="alert">
  <strong>Error/es</strong>
  {foreach from=$errores item=e}
    <p>{$e}</p>
  {/foreach}

  </div>
{/if}





<form role="form" action="/participa/add/" method=post>
  <div class="form-group">
    <label>Título</label>
    <input type="titulo" class="form-control" id=titulo name=titulo
           placeholder="Título de la acción" value="{$data.titulo}">
  </div>

  <div class="form-group">
    <label  >Descripción</label>
    <textarea class="form-control" id=texto name=txt>{$data.txt}</textarea>
  </div>


  <div class="form-group">
    <label  >Tipo</label>
    <select  class="form-control" name=tipo>
      <option value=0>Selecciones Tipo de Herramienta</option>
      {foreach from=$HerramientasParticipacion key=k item=i}
        <option  {if $k==$data.tipo} selected  {/if}value="{$k}">{$i.name}</option>
      {/foreach}
    </select>
  </div>

  <div class="form-group">
    <label  >Restringir a una comisión</label>
    <select  class="form-control" name=comision>
      <option value="-1">Disponible para tod@s</option>
      <option {if $data.comision=="0"}selected{/if} value="0">Miembro de cualquier comisión</option>
      {foreach from=$comisiones key=k item=i}
        <option {if $k==$data.comision} selected  {/if} value="{$k}">{$i}</option>
      {/foreach}
    </select>
  </div>


  <div class="form-group">
  <div class="checkbox">
      <label class="checkbox-inline">
      <input name=verificado value=1 id=verificado {if $data.verificado}checked{/if} type="checkbox"> 
      Solo para usuarios con verificación de identidad
    </label>
  </div>
  </div>

  <div class="form-group">
  <div class="checkbox">
      <label class="checkbox-inline">
      <input  name=inicio value="inicio" {if $data.inicio}checked{/if} type="checkbox" id=inicio > Fecha de Inicio Indeterminada
      </label>
  </div>  
  </div>


    <div class="form-group" id=divinicio  {if $data.inicio}style="display:none;"{/if}>
      <label for="Hashtag">Fecha de Inicio</label>

      <input type=text id=finicio name=finicio class="form-control" placeholder="dd/mm/aaaa" value="{$data.finicio}"> 
      <label for="Hashtag">Hora</label>

<select name=ihora >
{foreach from=$horas item=i}
<option {if $data.ihora==$i}selected{/if} value={$i}>{$i}</option>
{/foreach}
</select> 


<select name=iminuto>
{foreach from=$minutos item=i}
<option {if $data.iminuto==$i}selected{/if} value={$i}>{$i}</option>
{/foreach}
</select> 

    </div>




  <div class="form-group">
  <div class="checkbox">
      <label class="checkbox-inline">
      <input  name=fin value="fin" {if $data.fin}checked{/if} type="checkbox" id=fin > Fecha de Finalización Indeterminada
      </label>
  </div>  
  </div>






    <div class="form-group" id=divfin  {if $data.fin}style="display:none;"{/if}>
      <label for="Hashtag">Fecha de Finalización</label>

      <input type=text id=ffin name=ffin class="form-control" placeholder="dd/mm/aaaa" value="{$data.ffin}"> 
      <label for="Hashtag">Hora</label>

<select name=ihora >
{foreach from=$horas item=i}
<option {if $data.ihora==$i}selected{/if} value={$i}>{$i}</option>
{/foreach}
</select> 


<select name=iminuto>
{foreach from=$minutos item=i}
<option {if $data.iminuto==$i}selected{/if} value={$i}>{$i}</option>
{/foreach}
</select> 

    </div>










   <input type="submit" value="Crear Campaña" class="btn btn-block btn-primary">

</form>


</div>

<script>
{literal}



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


   
});


$( document ).ready(function() {

  $( "#rht" ).click(function() {
    if ($("#rht").is(':checked'))
    {
      $("#ht").hide();
      $("#htx").show();
    }
    else
    {
      $("#htx").hide();
      $("#ht").show();
    }
  });


  $('#finicio').datepicker({
    format: "dd/mm/yy",
    language: "es"
  });


  $('#inicio').change(function() {
    if ($(this).is(':checked'))
       $("#divinicio").hide();   
    else
       $("#divinicio").show();   
  });


  $('#ffin').datepicker({
    format: "dd/mm/yy",
    language: "es"
  });


  $('#fin').change(function() {
    if ($(this).is(':checked'))
       $("#divfin").hide();   
    else
       $("#divfin").show();   
  });





});






{/literal}


{/if}

</script>
