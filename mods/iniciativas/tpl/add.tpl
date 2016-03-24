
<div class=container>
<h1>Iniciativas</h1>
<h2>Añadir Iniciativa</h2>
<div class=row>

{if $msg}

<div class="alert alert-danger">ERROR: {$msg}</div>
{/if}

<form role="form" action="/iniciativas/add/go/" method=post>
  <div class="form-group">
    <label for="ejemplo_email_1">Título</label>
    <input type="text" class="form-control" name=titular
           placeholder="Use un título que describa con pocas palabras su iniciativa"
value="{$val.titular}"
>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1">Categoria</label>
    <select name=categoria class="form-control" id=listcategorias>
<option value=0>Seleccione una categoría</option>
{foreach from=$categorias item=i}
<option {if $val.categoria==$i.id}selected{/if} value={$i.id}>{$i.titulo}</option>
{/foreach}
</select>
<br><br>
<div class="panel panel-default">
   {foreach from=$categorias item=i}
<div {if $val.categoria<>$i.id}style="display:none;"{/if} id=cat{$i.id} class="txtdeunacategoria ">
  <div class="panel-heading">{$i.titulo}</div>
  <div class="panel-body">
  {$i.descripcion}
  </div>
</div>
  {/foreach}
</div>


  </div>
  <div class="form-group">
    <label for="ejemplo_archivo_1">Descripción de la iniciativa</label>
<textarea class="form-control" id=texto name=texto>{$val.texto}</textarea>

    <p class="help-block">Ejemplo de texto de ayuda.</p>
  </div>
  <button type="submit" class="btn btn-default">Enviar</button>
</form>
</div>
</div>



