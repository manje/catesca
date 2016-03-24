<?php

mostrartpl("cabecera.bs.tpl");

if ( ($op=="add") && ($isadmin) )
{
  mysql_query("insert into comisiones (id,titulo,descripcion) values 
    (NULL,\"".addslashes($_POST[titular])."\",\"".addslashes($_POST[texto])."\")
  ")
  
  ;
  unset($op);
}

if ($op=="ver")
{
  $sql="select * from comisiones where id = ".(int)$c[2];
  
  $permisos=GetPermiso($usuario,"comision",(int)$c[2]);
  if ($permisos>0)
  {
    $html->assign("list",ListUsuariosPermisos("comision",(int)$c[2]));
    $html->display("listado.tpl");
    
    
  }
  
}

if (  (!($op)) && ($isadmin) )
{
  if (! $isadmin) exit;
$sql="select * from comisiones order by titulo ";
$res=mysql_query($sql);
$out=Array();
while ($row=mysql_fetch_array($res))
{
  $id=$row[id];
  $out[$id]=$row;
}
$html->assign("comisiones",$out);
$html->display("index.tpl");
}




mostrartpl("pie.bs.tpl");

?>