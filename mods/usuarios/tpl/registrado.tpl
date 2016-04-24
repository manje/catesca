
<div class=container>
<div class=row>


<h1>Usuari@s</h1>

{if $msg}
<div class="alert alert-success">{$msg}</div>
{/if}
<span class="glyphicon glyphicon-user">
<strong>{$usuario.nick}</strong></span>

<br>
<span class="glyphicon glyphicon-envelope">
{$usuario.email}
</span>

<br>
{if $verificado}
<span class="glyphicon glyphicon-ok">
Identidad Verficada
</span>
{else}
<span class="glyphicon glyphicon-exclamation-sign">
Identidad Sin  Verficar:</span> 
<br>En breve se habilitará el mecanismo para la verificación.

{/if}




<hr>

{if $colaborador}
<form action="/usuarios/?go=colaborador" method=post>
<h2>Ficha de colaborador</h2>

Nombre: {$colaborador.nombre}
<br>Apellidos: {$colaborador.apellidos}
<br>Ocupación: {$colaborador.ocupacion}
<br>Móvil: {$colaborador.movil}
{if $colaborador.ciudad}<br>Ciudad: Jerez{/if}
<br>
{$colaborador.territoriotxt}
<br>Envío de correos: <input value=1 type=checkbox name=mailing {if $colaborador.mailing}checked{/if}>

<br>Envío de mensajes sms: <input value=1 type=checkbox name=moviling {if $colaborador.moviling}checked{/if}>

<hr>

<h3>Colaboraciones</h3>

<div class=row>
                     {foreach from=$intereses key=k item=i name=n}   
                       <div class="col-md-4" >
                        <h4>{$k}</h4>   
                          {foreach from=$i key=kk item=ii}   
                             <input {if in_array($kk, $interesesusuario)}checked{/if} type=checkbox name="{$kk}"> {$ii}
                             <br>
                          {/foreach}   
                       </div>   
                     {/foreach}   
</div>
<input type=submit class="btn btn-primary btn-lg btn-block" value="Modificar">


</form>
{else}
<form action="/usuarios/?go=colaborador" method=post role=form>

<h2>Date de alta como Colaborador/a</h2>
  <div class="form-group">
    <label >Nombre</label>
    <input type="text" class="form-control" name=nombre
           placeholder="Introduce tu nombre">
  </div>
  <div class="form-group">
    <label >Apellidos</label>
    <input type="text" class="form-control" name=apellidos
           placeholder="Introduce tus apellidos">
  </div>
  <div class="form-group">
    <label >Ocupación</label>
    <input type="text" class="form-control" name=ocupacion
           placeholder="Introduce tu ocupación">
  </div>
  <div class="form-group">
    <label >Nº Móvil</label>
    <input type="text" class="form-control" name=movil
           placeholder="solo para envíos de mensajes (sms, whatapp, telegram...)">
  </div>
  <div class="form-group">
    <label >Lugar de Residencia</label>
    <br>
    <input checked type=radio name=lugarresidencia id=lugarresidenciaa value=1 onclick="$('#distritodiv').show();$('#residenciadiv').hide();"> 
    {$ciudad}<br>
    <input type=radio name=lugarresidencia id=lugarresidenciab value=2 onclick="$('#distritodiv').hide();$('#residenciadiv').show();">
    Fuera de {$ciudad}
  </div>

{literal}
<script>
function cambiodistrito()   
{

  $("#distritotxt").hide();
  $("#distritotxt").html("");
  {/literal}
  {foreach from=$txtdistritos item=i key=k}
    if (  $("#distrito").val()=="{$k}" )  $("#distritotxt ").html("{$i}");
  {/foreach}
  {literal}

  if ( $("#distritotxt ").html() != "" ) $("#distritotxt").show();

}
</script>
{/literal}

  <div class="form-group">
    <label >Territorio</label>
  <div id=distritodiv>

                                <select name=distrito id=distrito onchange="cambiodistrito();" class="form-control">
                                <option value="0">Seleccione distrito</option>
                                {foreach from=$distritos key=k item=i}
                                <option value="{$k}">{$i}</option>
                                {/foreach}
                                </select>
                                <div id=distritotxt style="border: 1px solid #888; display: none; padding 5px;">
                                        sdkljfsd
                                </div>

  </div>
  <div id=residenciadiv  style="display:none;">

                                <select name=residencia id=residencia class="form-control">
                                <option value="0">Seleccione lugar de residencia</option>
                                {foreach from=$externos key=k item=i}   
                                <option value="{$k}">{$i}</option>
                                {/foreach}
                                </select>

  </div>
  </div>



  <div class="form-group">
    <label >
    	Acepto recibir mensajes de correo electrónico <input type=checkbox class="form-control" name=okmail checked value=1> </label>
  </div>
  <div class="form-group">
    <label >
        Acepto recibir mensajes a mi número de móvil <input type=checkbox class="form-control" name=okmovil checked value=1> </label>
  </div>



<div class=row>
                     {foreach from=$intereses key=k item=i name=n}   
                       <div class="col-md-4" >
                        <h4>{$k}</h4>   
                          {foreach from=$i key=kk item=ii}   
                             <input {if in_array($kk, $interesesusuario)}checked{/if} type=checkbox name="{$kk}"> {$ii}
                             <br>
                          {/foreach}   
                       </div>   
                     {/foreach}   

<input type=submit class="btn btn-primary btn-lg btn-block" value="Date de Alta como Colaborador/a">


</div>


</form>
{/if}





</div></div>



