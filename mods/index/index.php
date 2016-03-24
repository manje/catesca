<?php

mostrartpl("cabecera.bs.tpl");

if ($usuario->id==0)
  $html->display("portada_anonima.tpl");
else
{
  #print_r($usuario);
  $html->assign("verificado",$usuario->verificado);
  $html->assign("dataverificacion",$usuario->dataverificacion);
  $html->assign("verificaciones",$verificaciones);  
  if ($usuario->verificado)
  {
    $sql="select  v.*,unix_timestamp(fin) as timefin from votaciones v where votacion < now() and fin > now() order by fin ";
    
    $v=Array();
    $res=mysql_query($sql);
    while ($row=mysql_fetch_array($res))
    {
      $v[]=$row;
    }
    
    //
    $sql="select * from mesas ";
    $res=mysql_query($sql);
    $mesas=Array();
    while ($row=mysql_fetch_array($res))
    {
      $per=GetPermiso($usuario,"mesas",$row[id]);
      if ($isadmin) $per=100;
      if ($per>0) $mesas[]=$row;
      
    }
    
    $html->assign("mesas",$mesas);
    $html->assign("votaciones",$v);
  }
  $html->assign("colaborador",$usuario->GetColaborador());
  importclass("iniciativas");
  $cp=new ControladorPropuestas();
  $p=$cp->GetPropuestas();
  $pp=Array();
  $i=0;
  while ($i < 5)
  {
    if (isset($p[$i])) $pp[]=$p[$i];
    $i++;
  }  
  $html->assign("propuestas",$pp);
  
  $cp->orden="fecha";
  $p=$cp->GetPropuestas();
  $pp=Array();
  $i=0;
  while ($i < 5)
  {
    if (isset($p[$i])) $pp[]=$p[$i];
    $i++;
  }  
  $html->assign("propuestasultimas",$pp);
  
  $sql="select c.id,c.titulo,p.nivel
  from permisos p ,comisiones c 
  where p.usuario=".$usuario->id."
    and p.modulo='comision'
    and p.elemento=c.id
  order by p.nivel desc , c.titulo";
  $res=mysql_query($sql);
  $out=Array();
  while ($row=mysql_fetch_array($res))
  {
    $id=$row[id];
    $out[$id]=$row;
  }
  $html->assign("comisiones",$out);
      
  $html->display("portada.tpl");
}

mostrartpl("pie.bs.tpl");


?>