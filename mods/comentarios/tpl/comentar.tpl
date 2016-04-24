{if $usuario.id > 0 }
<div style="border: 1px solid #aaa;display:none;" id=cnew-{$cele}-0 >
<span class="glyphicon glyphicon-user"> 
<strong>{$usuario.nick}</strong>
</span>
<span class="glyphicon glyphicon-time"> 
Ahora mismo
</span>
<br>
<span id=txt-{$cele}-0>
</div>

<button
class="btn btn-primary btn-sm btn-block"
onclick="$('#form-{$cele}-0').toggle(100);"
id=poner-{$cele}-0
>Poner un comentario</button>


<div style="display:none;" id=form-{$cele}-0>
<textarea name=com-{$cele}-0 ></textarea>
<button 
onclick="enviarcomentario('{$cmod}',{$cele},0);"
class="btn btn-primary btn-sm btn-block">
Enviar</button>
</div>
{/if}