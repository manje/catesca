<div class=container>


<h1>Votación</h1>
<h2>Escrutinio</h2>
{foreach from=$votacion->datos.preguntas key=keyp item=p}
<div>
<h3>{$p.titulo}</h3>
{$escrutinio.$keyp.votos} votos
<br>
{$escrutinio.$keyp.blancos} blancos
  {if ($p.escrutinio=="vut")}
    <h4>Opciones seleccionadas</h4>
    <ol>
    {foreach from=$escrutinio.$keyp.resultado item=o}
       <li>
       {$p.opciones.$o.titulo}
       </li>
    {/foreach}
    </ol>
    <h4>Opciones descartadas</h4>
    <ol>
    {foreach from=$escrutinio.$keyp.perdedores item=o}
       <li>
       {$p.opciones.$o.titulo}
       </li>
    {/foreach}
    </ol>
    <button class=verlogvut{$keyp} onclick="$('.verlogvut{$keyp}').toggle();">Ver registro VUT</button>
    <button class=verlogvut{$keyp} style="display:none;" onclick="$('.verlogvut{$keyp}').toggle();">Ocultar registro VUT</button>
    <button class=verborda{$keyp} onclick="$('.verborda{$keyp}').toggle();">Ver tabla Borda</button>
    <button class=verborda{$keyp} style="display:none;" onclick="$('.verborda{$keyp}').toggle();">Ocultar tabla Borda</button>
    <pre class=verlogvut{$keyp} style="display:none;">
{foreach from=$escrutinio.$keyp.vutlog item=i}{$i}{/foreach}
    </pre>


<table class="table verborda{$keyp}" style="background-color: #fff;display:none;">
{foreach from=$escrutinio.$keyp.borda key=k item=o}
<tr><td>
{$p.opciones.$k.titulo}
<br>
{$k} </td>
<td>{$o.borda}</td>
<td>{$o.total}</td>
{foreach from=$o.tabla item=i}
  <td>{$i.num}<br>{$i.tpca}%<br>{$i.tpcb}%</td>
{/foreach}
</tr>
{/foreach}
</table>


  {/if}
</div>
{/foreach}
<a href="/votacion/{$votacion->id}/" class="btn btn-primary btn-lg btn-block"  >Volver</a>




</div>