</div>

<div class="four columns omega caja">


{if $usuario.id==0}

<form action="/usuarios/entrar/" method=post>
Email: <input type=text name=email>
Password: <input type=password name=pwd >
<input type=submit value="Entrar">
<br><strong><a href="/usuarios/#tabs-2b">Regístrese</a> <br>
<a href="/usuarios/#tabs-3c">¿Olvidó su contraseña?</a></strong>
</form>
<hr>


{else}
Estás registrado como <a href="/usuarios/">{$usuario.nick}</a>
<br>


<br>
<h3><a href="/usuarios/salir/">Salir</a></h3>


{if $menusadmin|@count > 0}
<div>
<h4>Menú Personalizado</h4>
  {foreach from=$menusadmin key=k item=i}
     <a href="{$i.url}">{$i.name}</a><br>
  {/foreach}
</div>
{/if}




{/if}
<h4>Manual Votación</h4>
<a href="http://www.ganemosjerez.es/wp-content/uploads/2015/03/ManualVotacionInternet.pdf"
>ManualVotacionInternet.pdf</a>
<h4>¿Qué es esto?</h4>
Sistema de primarias de Ganemos Jerez
<hr>
Ganemos Jerez, como responsable de los ficheros, considera que en el momento que nos facilita sus datos de carácter personal a
 través de los diversos formularios que contiene esta página web o mediante correo electrónico, 
nos está otorgando su autorización y consentimiento expreso para el tratamiento de sus datos en nuestros ficheros, 
si bien con carácter revocable y sin efectos retroactivos, y acepta las políticas de privacidad 
respecto a sus datos, que serán tratados con absoluta confidencialidad y cumpliendo todas las 
exigencias legales recogidas en la Ley Orgánica 15/1999 de Protección de Datos de Carácter 
Personal (LOPD) y Real Decreto 1720/2007 de desarrollo de la LOPD y demás legislación aplicable. 
Las presentes políticas de privacidad se rigen por la normativa exclusivamente aplicable en España,  quedando 
sometida a ella, tanto nacionales como extranjeros que utilicen esta web.

</div>


</div>

		<div class="sixteen columns pie">
{$titulopagina}
</div>


	</div><!-- container -->

{if $msg}
  <script type="text/javascript">
       jQuery.noticeAdd({literal}{{/literal}
 text: '{$msg}',
   stay: false
     });
</script>
{/if}

<!-- End Document
================================================== -->
</body>
</html>
