<div class=container>


<h1>Votación</h1>



<strong>{$votacion->titulo}</strong>

<br>
Usted ya ha votado:

<p>
<strong>Fecha:</strong> {$yahavotado.fecha}
<br>
<strong>Mesa:</strong>

 {if $yahavotado.mesa==0} 
Voto electrónico
{else}
nº {$yahavotado.mesa}  
{/if}
</p>
<a href='/votacion/{$votacion->id}/' class="btn btn-primary">Volver</a>






</div>