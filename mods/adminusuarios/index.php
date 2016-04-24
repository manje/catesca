<?php

mostrartpl("cabecera.bs.tpl");

$op=sololetras($op);
$subop=(int)$subop;

if ($isadmin) $n=100;

if ($n < 100) $n=GetPermiso($usuario,$op,$subop);


if ($n < 100) 
{
  if ($op=="marca")
  {
    $m=new Marca($subop);
    if ($m->id > 0)
    {
      $n=GetPermiso($usuario,"proveedor",$m->proveedor);
    }
  }
}

if ($n==100)
{
  $html->assign("listusuarios",ListUsuariosPermisos($op,$subop));
  $html->assign("modulo",$op);
  $html->assign("elemento",$subop);
  $html->display("list.tpl");
  
}

mostrartpl("pie.bs.tpl");


