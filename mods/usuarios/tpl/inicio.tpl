


{if $usuario.id==0}
<div class=container>
<div class=row>

<div class="col-md-12" >

<div class="col-md-3" >&nbsp;</div>

<div class="col-md-6" style="
background-color: #fff;
padding: 20px;
margin-top: 20px;
border: 3px solid #aaa;
border-radius: 10px;


">
<h2>Acceso</h2>





                <form action="/" role="form"  method=post>
                    <div class="form-group">
                         <label for="email">Email:</label>
                        <input type="text" placeholder="Email" name="introemail" class="form-control" value="{$introemail}">
                    </div>
                    <div class="form-group">
                         <label for="email">Contraseña:</label>
                        <input type="password" placeholder="Password" name="intropwd" class="form-control">
                    </div>
                    <button class="btn btn-default" type="submit">Entrar</button>
                </form>




</div>
</div>



<h1>Usuari@s</h1>

{if $msg}
<div class="alert alert-success">{$msg}</div>
{/if}

<div class="col-md-6" >

<h2>Regístrese</h2>

<form role="form" action="/usuarios/alta/" method=post>
  <div class="form-group">
    <label for="ejemplo_email_1">Email</label>
    <input type="email" class="form-control" id="ejemplo_email_1" name=email
           placeholder="Introduce tu email">
  </div>
  <button type="submit" class="btn btn-default">Enviar</button>
</form>

</div>
<div class="col-md-6" >



<h2>¿Olvidó su contraseña?</h2>
<form role="form" action="/usuarios/recordar/" method=post>
  <div class="form-group">
    <label for="ejemplo_email_1">Email</label>
    <input type="email" class="form-control" id="ejemplo_email_1" name=email
           placeholder="Introduce tu email">
  </div>
  <button type="submit" class="btn btn-default">Enviar</button>
</form>


</div>




</div></div>





{else}
   {include file="registrado.tpl"}   
{/if}