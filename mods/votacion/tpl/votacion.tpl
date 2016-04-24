<div class=container>


<h1>Votación</h1>



<div class="panel panel-default">
         <div class="panel-heading">
           <div class="container">
           <div class="row">

<h2>{$votacion->titulo}</h2>

           </div>
           </div>
         </div>

         <div style="clear: both;" class="panel-body">
{$votacion->txt}

         </div>
</div>


<strong>Inicio:</strong> {$votacion->inicio}<br>
<strong>Fin:</strong> {$votacion->fin}<br>
<strong>Participación:</strong> {$participacion.total}<br>
{if $votacion->activa}
{if $usuario.id==0}
<a href='/usuarios/' class="btn btn-primary" >Iniciar Proceso de Votación</a>
{else}
<a href='/votacion/{$votacion->id}/votar/' class="btn btn-primary" >Iniciar Proceso de Votación</a>
{/if}
{/if}

</div>