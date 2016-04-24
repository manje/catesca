
<script>
  var modulo="{$modulo}";
  var elemento={$elemento};
  var idaeliminar=0;
</script>

<div class="modal fade" id="form-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Añadir Usuario/a
            </div>
            <div class="modal-body">
Introduzca Email<br>
  <select id=rol name=rol>
  <option value=50>Miembro</option>
  <option value=100>Coordinador/a</option>
</select><br>
  <input type=text  placeholder="email@email.com" id=emailanadir name=anadirmail>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button  id=anadirusu class="btn btn-danger danger">Añadir</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form-eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Eliminar Usuario/a
            </div>
            <div class="modal-body">

¿Está seguro que desea eliminar este usuario?

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id=eliminarusuboton class="btn btn-danger danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="dialogoeliminar" title="Eliminar Usuario">
¿Está seguro que desae eliminar este usuario?
</div>


<table class="table mm_tabUsuarios">
				<thead>
					<tr>
						<th colspan="3">
					<h5 class="mm_margin0"><img src="/img/ico_usuario.png" alt="" class="">Usuarios</h5>
					<p class="mm_margin0"><span class="mm_azul">Usuarios registrados: </span> {$listusuarios|@count}</p>
						</th>
						<th colspan="2" class="mm_float-right mm_vealing">

<a data-toggle="modal" data-target="#form-add" href="#">Añadir Usuario</a>
						</th>
					</tr>
				</thead>
				<tbody>



					<tr>
						<td colspan=4>

<div>

</div>

</td>

					</tr>




					<tr>
						<td>
							 <span class="mm_margin0 mm_negrilla">Foto</span>
						</td>
						<td>
							<span class="mm_margin0 mm_negrilla">Nombre y cargo</span>
						</td>
						<td><span class="mm_margin0 mm_negrilla">Email</span></td>
						<!--td><span class="mm_margin0 mm_negrilla">Marcas</span></td-->
						<td>&nbsp;</td>
					</tr>






{foreach from=$listusuarios item=u}




					<tr>
						<td>
								 	<div class="mm_foto">
								 		<img src="/media/usuario/{$u->id}/?h=61" alt="">	
								 	</div>
						</td>
						<td class="mm_vealing">
								 	<span class="mm_azul">{$u->nick}<br>
								 			<small class="mm_azul-marino">{if $u->nivel==100}Coordinador/a{else}Miembro{/if}</small>
								 	</span>
						</td>
						<td class="mm_vealing">
							<span class="mm_azul">{$u->email}</span>
						</td>
						<!--td class="mm_vealing">
							<span class="mm_azul">.</span>
						</td-->
						<td class="mm_vealing">
							<span mm_v-center="">
								<!--a href="#" title="Editar"><img src="/img/ico_edit.png" alt=""></a-->
								<a href="javascript:eliminarusu({$u->id},modulo,elemento);" title="Eliminar"><img src="/img/ico_delete.png" alt=""></a>
							</span>
						</td>
					</tr>

{/foreach}





				</tbody>
</table>

