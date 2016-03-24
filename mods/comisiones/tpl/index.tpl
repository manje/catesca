
<h1>Comisiones</h1>
<h2>Añadir Comisión</h2>
<div class=container>
<div class=row>

{if $msg}

<div class="alert alert-danger">ERROR: {$msg}</div>
{/if}

<ul>
{foreach from=$comisiones item=c}
  <li>#{$c.id} - <a href='/adminusuarios/comision/{$c.id}/'>{$c.titulo}</a></li>
{/foreach}
</ul>

<hr>
<form role="form" action="/comisiones/add/go/" method=post>
  <div class="form-group">
    <label for="ejemplo_email_1">Título</label>
    <input type="text" class="form-control" name=titular
           placeholder="Use un título que describa con pocas palabras la comisión"
value="{$val.titular}"
>
  </div>


  <div class="form-group">
    <label for="ejemplo_archivo_1">Descripción de la comisión</label>
<textarea class="form-control" id=texto name=texto>{$val.texto}</textarea>

  </div>
  <button type="submit" class="btn btn-default">Añadir</button>
</form>
</div>
</div>



