<?php


  $m=sololetras($_POST[idm]);
  $e=(int)$_POST[ide];

  if ($isadmin) $n=100;
  
            
  if ($n < 100) $n=GetPermiso($usuario,$m,$e);


  if ($n!=100) exit;

  if ($op=="eliminarusu")
  {

     $u=new Usuarios(false,(int)$_POST[idu]);
     SetPermiso($u,$m,0,$e);
     echo json_encode(true);
  }
  
  if ($op=="anadirusu")
  {
    $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
    if(preg_match($Sintaxis,$_POST[emailu]))
    {
      $n=(int)$_POST[rol];
      if ($n > 0) PermisosInvitar($_POST[emailu],$m,$e,$n);
      $res=true;
      $txt="Vinculación enviada";
    }
    else
    {
      $res=false;
      $txt="Email no válido";
    }
    $r[res]=$res;
    $r[txt]=$txt;
    echo json_encode($r);
  }

