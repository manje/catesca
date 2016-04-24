<div class=container>

<h2>Edición de Opciones</h2>

<div class="col-md-8">


{$opciones|@count} opciones
<table class=table>
{foreach from=$opciones item=o key=k}
<tr><td>#{$k}</td><td>{$o.titulo}</td>

<td>

<a href="/votacion/{$votacion->id}/postconf/opciones/{$idp}/del/{$k}/" class="btn btn-primary">Borrar</a>

</td>
</tr>
{/foreach}
</table>

</div>




<div class="col-md-4">
<h3>Añadir Opción</h3>
<form action="/votacion/{$votacion->id}/postconf/opciones/{$idp}/add/" method=post id=formadd>

  <div class="form-group">
    <input type="titulo" class="form-control" id="titulo" name=titulo
         placeholder="Opción" >
  </div>

  <div class="btn-group " role="group" >
    <input type=submit class="btn btn-primary" value="Añadir">
  </div>
</form>
<a href="/votacion/{$votacion->id}/postconf/" class="btn btn-primary">Volver a la pregunta</a>

</div>





</div>