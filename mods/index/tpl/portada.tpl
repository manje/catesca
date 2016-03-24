
<div class=container>
<div class=row>


<h1>{$titulopagina}</h1>

{if $msg}
<div class="alert alert-success">{$msg}</div>
{/if}


<div class="col-md-6" >
<h3>Tus Datos</h3>
<div class="well well-sm">
<span class="glyphicon glyphicon-user">
<strong>{$usuario.nick}</strong></span>

<br>
<span class="glyphicon glyphicon-envelope">
{$usuario.email}
</span>

<br>
{if $verificado}
<span class="glyphicon glyphicon-ok">
Identidad Verficada
</span>
{else}
<span class="glyphicon glyphicon-exclamation-sign">
Identidad Sin  Verficar:</span> 
<a href='/verificar/presencial/'>Verificar identidad</a>
{/if}

{if $colaborador}
<br><span class=".glyphicon .glyphicon-transfer">Colaborador <a href="/usuarios/">editar</a></label>
{else}
<br><a href="/usuarios/" class="btn btn-primary btn-lg">Hazte Colaborador/a de {$organizacion}</a></label>
{/if}


</div>



{if $comisiones|@count >0}
<h3>Tus comisiones</h3>

  <div class="well well-sm">
  {foreach from=$comisiones item=c}

    <strong>{$c.titulo}</strong> 

    {if $c.nivel==100}
       <a href="/adminusuarios/comision/{$c.id}/">Administrador</a>
    {else}  
       <a href="/comisiones/ver/{$c.id}/">ver Miembros</a>
    {/if}

    <br>

{/foreach}
  </div>



{/if}



</div>




<div class="col-md-6" >
<!--h2><a  class="btn btn-primary btn-lg" href="/iniciativas/">Iniciativas</a></h2-->
<h3>Últimas Iniciativas</h3>
<div class="well well-sm">
{foreach from=$propuestasultimas item=p}
<a href="/iniciativas/p/{$p->id}/">{$p->titular}</a> hace {$p->fechatxt}<br>
{/foreach}
</div>
<a href="/iniciativas/?orden=fecha">Ver más</a>
<h3>Mejores Iniciativas</h3>
<div class="well well-sm">

{foreach from=$propuestas item=p}
<a href="/iniciativas/p/{$p->id}/">{$p->titular}</a><br>
{/foreach}
</div>
<a href="/iniciativas/?orden=valor">Ver más</a> <br><br>


<a class="btn btn-primary btn-lg btn-block" href="/iniciativas/add/">Crear Iniciativa</a>

</div>




</div></div>



