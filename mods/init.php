<?php
$menusadmin=Array();
$cola=false;
foreach ($verificaciones as $k=>$v)
{
  $p=GetPermiso($usuario,$k);

  if ($p>0)
  {
    $m=Array();
    if ($v[cola]) 
      $cola=true;
    else
    {
      $m[url]="/verificar/admin/$k/";
      $m[name]="Verificar $k";
      $m[p]=$p;
      $menusadmin[]=$m;
    } 
  }
}
if ($cola)
{
    $m=Array();
    $m[url]="/verificar/admin/cola/";
    $m[name]="Cola de Verificación";
    $m[p]=$p;
    $menusadmin[]=$m;

}
$html->assign("menusadmin",$menusadmin);


