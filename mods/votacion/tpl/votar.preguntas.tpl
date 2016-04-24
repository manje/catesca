<div class=container>


<h1>Votación</h1>

{if !$votacionvalida}
<div class="alert alert-success">
<strong>Su voto todavía no ha sido enviado</strong><br>
  No podrá enviar su voto hasta que responda a las preguntas obligatorias.
</div>
{/if}

<h2>Preguntas</h2>


{if $votacionvalida}
<a href="/votacion/{$votacion->id}/votar/confirmar/" class="btn btn-primary btn-lg btn-block" id=confirmarvotos>Confirmar y enviar voto</a>
{/if}



<table class=table>
<thead>
<tr>
<th>Pregunta</td>
<th>Mecánica de voto</td>
<th>Escrutinio</td>
</tr>
</thead>
<tbody>
{foreach from=$votacion->datos.preguntas key=k item=p}
<tr>
    <td><strong>{$p.titulo}</strong><br>{$p.descripcion}</td>
    <td>{$p.mecanica}</td>
    <td>{$p.escrutinio}</td>
    <td>{$p.opciones|@count} Opciones<td>
    <td>
      {if $voto.$k|@count==0}
         <a class="btn btn-primary" href='/votacion/{$votacion->id}/votar/prg/{$k}/'>Votar</a>
      {else}
         <a class="btn btn-primary" href='/votacion/{$votacion->id}/votar/prg/{$k}/'>Modificar Votación</a>
      {/if}
{if $p.minop > $voto.$k|@count}
<br>
<span class="glyphicon glyphicon-alert"> </span> Obligatorio elegir 
{$p.minop}
opcion{if $p.miniop>1}es{/if}
{/if}
    </td>



</td>
</tr>
{/foreach}
</tbody>
</table>

{if $votacionvalida}
<a href="/votacion/{$votacion->id}/votar/confirmar/" class="btn btn-primary btn-lg btn-block" id=confirmarvotos>Confirmar y enviar voto</a>
{/if}


</div>