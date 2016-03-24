



<div class=container>
     
     <h1>Iniciativas</h1>

<div class=row>


<div class="col-md-10" >



{if $categoria}
<div style="margin: 5px; padding:5px;" class="bg-primary">
<strong>{$categoria.titulo}:</strong> 
{$categoria.descripcion}
</div>
{/if}
<div aria-label="Justified button group with nested dropdown" role="group" class="btn-group btn-group-justified">
      <a role="button" class="btn btn-default" href="?orden=valor"  {if $orden=="valor" }style='font-weight: bold;'{/if} >Más Votadas</a>
      <a role="button" class="btn btn-default" href="?orden=puntos" {if $orden=="puntos"}style='font-weight: bold;'{/if}>Más Populares</a>
      <a role="button" class="btn btn-default" href="?orden=fecha"  {if $orden=="fecha" }style='font-weight: bold;'{/if}>Últimas</a>

      {*<div role="group" class="btn-group">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" href="#">
          Dropdown <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider" role="separator"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div>*}
</div>



<ul class="pager">
  {if $pag>0}<li class="previous"><a href="?pag={$paga}&orden={$orden}">&larr; Anterior</a></li>{/if}
  {if $paginas > $pag}<li class="next"><a href="?pag={$pags}&orden={$orden}">Siguiente &rarr;</a></li>{/if}
</ul>


     
     
     {foreach from=$propuestas item=p}
     
         {include file="propuesta.tpl"}     
     
     {/foreach}
     
     
     
     
     

</div>
<div class="col-md-2" >
{if $usuario.id == 0}
   <strong>Debe registrarse para enviar una iniciativa</strong>
{else}
   <a href="/iniciativas/add/"  class="btn btn-primary btn-lg btn-block">Crear Iniciativa</a>
{/if}
   <h4>Categorias</h4>
   {foreach from=$categorias key=k item=c}
     <a href="/iniciativas/categoria/{$c.id}/">{$c.titulo}</a>
     <span style="cursor: pointer;" onclick="$('#catid{$k}').toggle();" aria-hidden="true" class="glyphicon glyphicon-question-sign"></span>
     <div id=catid{$k} style="display:none;">
       {$c.descripcion}
     </div>
     <br>
   {/foreach}
   </ul>

</div>
     



</div>
</div>



