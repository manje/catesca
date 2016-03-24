



<div class=container>
     
     <h1>Propuestas</h1>

<div class=row>


<div class="col-md-10" >

<ul class="pager">
  {if $pag>0}<li class="previous"><a href="?pag={$paga}">&larr; Anterior</a></li>{/if}
  {if $paginas > $pag}<li class="next"><a href="?pag={$pags}">Siguiente &rarr;</a></li>{/if}
</ul>


     
     
     {foreach from=$propuestas item=p}
     
         {include file="propuesta.tpl"}     
     
     {/foreach}
     
     
     
     
     

</div>
<div class="col-md-2" >
{if $usuario.id == 0}
   <strong>Debe registrarse para enviar una propuesta</strong>
{else}
   <a href="/propongo/add/"  class="btn btn-primary btn-lg btn-block">Crear Propuesta</a>
{/if}
   <h4>Categorias</h4>
   <ul>
   {foreach from=$categorias item=c}
     <li><a href="/propongo/categoria/{$c.id}/">{$c.titulo}</a><br>{$c.descripcion}</li>
   {/foreach}
   </ul>

</div>
     



</div>
</div>



