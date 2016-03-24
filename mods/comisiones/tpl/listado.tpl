


<div class=container>
<div class=row>

{if $msg}

<div class="alert alert-danger">ERROR: {$msg}</div>
{/if}

<table class="table table-striped">
<thead>
<tr><th>Nombre</th><th>Email</th></tr>
</thead>
<tbody>
{foreach from=$list item=u}
  <tr><td>{$u->nick}</td><td>{$u->email}</td><td>{if $u->nivel==100}<strong>Administrador</strong>{else}Miembro{/if}</td></tr>
{/foreach}
</tbody>
</table>



</div>
</div>



