<div class=container>
<div class="row" style="background: #fff">

  <div class="col-md-12" >
  
<h3>{$pregunta.titulo}</h3>
  </div>
  

  <div class="col-md-6" >
  
    <h1>Opciones</h1>
  
    {foreach from=$pregunta.opciones key=k item=i}
    <div id=opcion{$k} onclick="javascript:selop('{$k}');" style="padding: 3px;cursor:move;border-radius: 5px; margin: 3px;border: 1px solid #aaa;">
      {$i.titulo}
    </div>
    {/foreach}
  
  </div>

  <div class="col-md-6" >
  
    <h1>Papeleta</h1>
    
<style>{literal}
.opcion {
background-color: #aaa;
xxlist-style: square;
padding: 2px;
border-radius: 3px;
margin: 3px;
}
</style>{/literal}

<strong>
 Selecciones sus opciones de forma ordenada (la primera opción es más importante que la última)
</strong>


<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>¡Atención!</strong> El orden importa. Seleccione sus opciones de forma ordenada (la primera opción es más importante que la última) <a 
target="_blank" href="https://es.wikipedia.org/wiki/VUT">+info</a></div>


    <ol id="papeleta">

    </ol>

<br>
Mínimo {$pregunta.minop} opciones y máximo {$pregunta.maxop}
  </div>
  


<div class=" btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button onclick="javascript:guardarpapeleta();" type="button" class="btn btn-primary">Guardar</button>
  </div>
  <div class="btn-group" role="group">
    <a href="/votacion/{$votacion->id}/votar/" class="btn btn-default">Cancelar</a>
  </div>
</div>

  
  </div>



</div></div>
<script>
voto=JSON.parse('{$voto}');
opciones=JSON.parse('{$opcionesjson}');
idvotacion={$votacion->id};
idpregunta={$idp};
maxopciones={$pregunta.maxop};

{literal}


{/literal}


</script>
