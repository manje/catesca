<div class=container>


<h1>Votación</h1>
<h2>Confirmación de voto</h2>

<div class="alert alert-success">
Su voto aún no ha sido enviado, compruebe que es correcto y envíelo.
</div>

<a href="/votacion/{$votacion->id}/votar/final/" class="btn btn-primary btn-lg btn-block"  >Enviar</a>



<div class=row>
    {foreach from=$votacion->datos.preguntas key=k item=i}
    <div class="col-md-3" >
    <div style="background: #fff; padding: 5px; margin: 5px;">
       <p><strong>{$i.titulo}</strong></p>
<hr>
       <ol>
       {foreach from=$voto.$k item=v}
          <li>{$i.opciones.$v.titulo}</li>
       {/foreach}
       </ol>
    </div>
    </div>
    {/foreach}
</div>

<a href="/votacion/{$votacion->id}/votar/final/" class="btn btn-primary btn-lg btn-block"  >Enviar</a>




</div>