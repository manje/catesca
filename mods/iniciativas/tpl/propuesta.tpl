

     
       <div class="panel panel-default">
         <div class="panel-heading">
           <div class=container>
           <div class=row>
             <div class="col-md-1 " style=" border: 0px solid #000; cursor:move;">

     <div id=pro{$p->id}up  onclick="javascript:votar({$p->id},1);"  
          style="text-align: center;{if $p->votousuario==1}background-color: #f00;{/if}" ><span class="glyphicon glyphicon-thumbs-up"></span> 
     <span id=pro{$p->id}uptxt>{$p->up}</span></div>
     
     <div id=pro{$p->id}clear  onclick="javascript:votar({$p->id},2);" style="text-align: center;"><span class="glyphicon glyphicon-remove-circle"></span> </div>
     
     <div id=pro{$p->id}down   onclick="javascript:votar({$p->id},3);" style="text-align: center;{if $p->votousuario==3}background-color: #f00;{/if}" ><span class="glyphicon glyphicon-thumbs-down"></span> 
     <span id=pro{$p->id}downtxt>{$p->down}</span></div>
     
     
     
     
             </div>
             <div class="col-md-9" ><h2 class="  panel-title"><a href='/iniciativas/p/{$p->id}/'><strong>{$p->titular}</strong></a></h2>
<span class="glyphicon glyphicon-user"> 
<strong>{$p->autor->nick}</strong>
</span>
<span class="glyphicon glyphicon-time"> 
Hace {$p->fechatxt}</span>
{*
<span class="glyphicon glyphicon-stats">
{$p->puntos}</span>
*}


<span class="glyphicon glyphicon-search">
<a href='/iniciativas/categoria/{$p->idcat}/'>{$p->categoria}</a>
</span>

</div>
           </div>
           </div>
         </div>

         <div class="panel-body" style="clear: both;">
{if $op=="p"}

           {$p->texto}

{else}
<div id=text{$p->id}mini {if !$p->textomini}  style="display:none;"{/if}>
{$p->textomini}... <a href="#" onclick="javascript:$('#text{$p->id}mini').hide();$('#text{$p->id}min').show();return false;">Ver más</a>
</div>
<div id=text{$p->id}min {if $p->textomini} style="display:none;"{/if}>
           {$p->texto}
</div>
{/if}
         </div>
       </div>
     

{if $comhtml}
Comentarios:
{$comhtml}

{/if}