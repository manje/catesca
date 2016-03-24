



<div class=container>
     
     <h1>Iniciativas</h1>

<div class=row>

<div class="col-md-10" >




     
     
     {foreach from=$propuestas item=p}
     
         {include file="propuesta.tpl"}     
     
     {/foreach}
     
     
     
     
     

</div>
<div class="col-md-2" >


{if $isadmin}
   <a id=btnseleccionar  class="btn btn-primary btn-lg btn-block">Seleccionar</a><br>
{/if}


{if $usuario.id == 0}
   <strong>Regístrese y conviértase en colaborador de esta iniciativa</strong>
{else}



    <div id=diviscol  {if !$IsColaborador}style="display:none;"{/if}  class="btn-group">
      <button type="button" class="btn btn-primary">Eres Colaborador</button>
     
      <button type="button" class="btn btn-primary dropdown-toggle"
              data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Desplegar menú</span>
      </button>
     
      <ul class="dropdown-menu" role="menu">
        <li><a id=DEScolaborar href="#">Dejar de serlo</a></li>
      </ul>
    </div>

    <a {if $IsColaborador}style="display:none;"{/if} id=divnotiscol href="#" class="btn btn-primary  btn-block">Hazte Colaborador</a>





















{/if}

{$p->numcolaboradores|number_format:0:',':'.'} colaborador@s


   <h4>Categorias</h4>


   {foreach from=$categorias key=k item=c}
     <a href="/iniciativas/categoria/{$c.id}/">{$c.titulo}</a>
     <span style="cursor: pointer;" onclick="$('#catid{$k}').toggle();" aria-hidden="true" class="glyphicon glyphicon-question-sign"></span>
     <div id=catid{$k} style="display:none;">
       {$c.descripcion}
     </div>
     <br>
   {/foreach}


</div>
     



</div>
</div>






{literal}

<script>
$( document ).ready(function() {

idpropuesta={/literal}{$p->id}{literal}


});
</script>


{/literal}

