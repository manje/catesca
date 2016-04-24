



<div class=container>
     
     <h1>Categorias</h1>

<div class=row>






{if ($id > 0) ||($op=="add") } 

<div class="col-md-12" >

<form role="form" action="/categorias/{$op}/" method=post>
  <div class="form-group">
    <label for="ejemplo_email_1">Título</label>
    <input type="text" class="form-control" name=titulo
           placeholder="Use un título que describa con pocas palabras su propuesta"
value="{$editar.titulo}"
>
  </div>
  <div class="form-group">
    <label for="ejemplo_email_1">Privado</label>

    <input type="checkbox" name=nivel {if $editar.nivel==100}checked{/if} value=100 >
  </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_archivo_1">Descripción</label>
<textarea class="form-control" id=texto name=descripcion>{$editar.descripcion}</textarea>

    <p class="help-block">Ejemplo de texto de ayuda.</p>
  </div>
  <button type="submit" class="btn btn-default">Guardar</button>
</form>
</div>
     
{else}


<div class="col-md-12" >


<table class=table table-bordered " >
{foreach from=$categorias item=c key=k}
<tr><td>
{$c.id}
</td><td>
<a href='/categorias/{$c.id}/'>
{$c.titulo}
</a>
</td><td>

{if $c.nivel>0}PRIVADO{/if}

</td></tr>

{/foreach}

</table>
     
<a class="btn btn-primary btn-lg" href="/categorias/add/">Nueva Categoria</a>

</div>

{/if}



</div>
</div>



