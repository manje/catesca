{if $msg}

<div style="
border: 1px solid #000;
border-radius: 20px;
padding: 30px;
margin: 30px;
font-size: 12pt;
">
<!--strong style="color: #f00;font-size: 20pt;">Error:</strong-->
{$msg}</div>

{/if}
<p>Seleccione un nombre, y una contraseña, para completar el registro:</p>


<form action="/usuarios/alta3/" method=post>
<input type=hidden name=pwd value='{$pwd}'>
Email: {$email}<br />
Nombre y Apellidos: <input type=text name=u value="{$nick}"><br>
Contraseña: <input type=password name=pa value="{$pab}"><br>
Contraseña: (repetir)<input type=password name=pb value="{$pab}"> (repetir) <br>
<input type=submit value=Enviar>

</form>
