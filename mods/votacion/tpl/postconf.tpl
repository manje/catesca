<div class=container>

{if $ocultarformadd}
<h2>Preguntas:</h2>

<table class=table >
{foreach from=$votacion->datos.preguntas key=k item=vot}
  <tr><td colspan=2>{$vot.titulo}</td></tr>
  <tr><td>#{$vot.mecanica} #{$vot.escrutinio}</td><td>
<a class=button href='/votacion/{$votacion->id}/postconf/opciones/{$k}/'>  {$vot.opciones|@count}  Opciones de voto</a>

</td></tr>


{/foreach}
</table>

<button id=botonadd class="btn btn-primary">Añadir Pregunta</button>
{/if}

<form action="/votacion/{$votacion->id}/postconf/addp/" method=post id=formadd {if $ocultarformadd}style="display: none;"{/if}>

  <h2>Añadir Pregunta</h2>


{if $errores}
  <div class="alert alert-danger" role="alert">
  <strong>Error/es</strong>
  {foreach from=$errores item=e}
    <p>{$e}</p>
  {/foreach}

  </div>
{/if}




  <div class="form-group">
    <label >Titulo Pregunta</label>
    <input type="titulo" class="form-control" id="titulo" name=titulo
         placeholder="Introduce la pregunta" value="{$post.titulo}">
  </div>
  <div class="form-group">
    <label>Descripción (opcional)</label>
    <textarea class="form-control" id="descripcion" name="descripcion">{$post.descripcion}</textarea>

  </div>

  <div class="form-group">
    <label>Mecánica de voto</label>
    <select class="form-control" id=mecanica name=mecanica>
      <option {if $post.mecanica=="0"}selected{/if} value="0">Seleccione Mecánica de voto</option>
      <option {if $post.mecanica=="una"}selected{/if} value="una">Elige una opción</option>
      <option {if $post.mecanica=="varias"}selected{/if} value="varias">Elige varias opciones</option>
      <option {if $post.mecanica=="preferente"}selected{/if} value="preferente">Elige varias opciones y ordenarlas</option>
    </select>
  </div>

  <div class="form-group">
    <label>Escrutinio</label>
    <select class="form-control" id=escrutinio name=escrutinio>
      <option {if $post.escrutinio=="0"}selected{/if} value="0">Seleccione método de escrutinio</option>
      <option {if $post.escrutinio=="totales"}selected{/if} value="totales">Totales</option>
      <option {if $post.escrutinio=="vut"}selected{/if} value="vut">VUT</option>
      <option {if $post.escrutinio=="borda"}selected{/if} value="borda">Borda</option>
    </select>
  </div>


  <div class="form-group" id=divtipovut {if $post.escrutinio!="vut"}style='display:none;'{/if}>
    <label>Tipo de VUT</label>
    <select class="form-control" id=tipovut name=tipovut>
      <option {if $post.tipovut=="0"}selected{/if} value="0">Seleccione tipo de VUT</option>
      <option {if $post.tipovut=="numero"}selected{/if} value="numero">Nº determinado de opciones ganadoras</option>
      <option {if $post.tipovut=="ranking"}selected{/if} value="ranking">Ranking</option>
    </select>
  </div>

  <div class="form-group" id=divnumvut {if $post.tipovut!="numero"}style='display:none;'{/if}>
    <label>Número de opciones ganadoras</label>
    <input type =text class="form-control" id=numvut name=numvut values="$post">
  </div>

  <div class="form-group" id=minymax >
    <label>Número mínimo y máximo de opciones elegibles</label>
    <input type=text class="form-control" id=minop name=minop value="{$post.minop}">
    <input type=text class="form-control" id=maxop name=maxop value="{$post.maxop}">
  </div>

  <div class="form-group">
    <label>Características de cada opción (además del título)</label><br>
    <label><input {if $post.op_descripcion==1}checked{/if} type="checkbox" value="1" id=op_descripcion name=op_descripcion > Descipción</label><br>
    <label><input {if $post.op_img==1}checked{/if} type="checkbox" value="1" id=op_img name=op_img > Imagen</label><br>
    <label><input {if $post.op_file==1}checked{/if} type="checkbox" value="1" id=op_file name=op_file > Fichero</label><br>
  </div>

  <div  lass="btn-group " role="group" >
    <input type=submit class="btn btn-primary" value="Guardar">
    <button id=botoncancelar type="button" class="btn btn-default">Cancelar</button>
  </div>


</form>



</div>