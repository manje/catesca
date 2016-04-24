<?php

/*

CREATE TABLE permisos (
  usuario int(11),
  modulo char(50),
  elemento int(11),
  nivel int(11),
  primary key(usuario,modulo,elemento)
);
        
        usuario: id del usuario
        modulo: tipo de permisos (proveedor, marca, agencia, etc.)
        elemento: id del proveedor, marca, agencia, etc.
        nivel: nivel de los permisos, de momento siempre 100

*/

function ListUsuariosPermisos($modulo,$elemento)
{
  $sql="select * from permisos where modulo='$modulo' and elemento=$elemento ";
  $sal=Array();
  $res=mysql_query($sql);
  while ($row=mysql_fetch_array($res))
  {
    $u=new Usuarios(false,(int)$row[usuario]);
    $u->nivel=(int)$row[nivel];
    $sal[]=$u;
  }
  return $sal;
}

function GetPermiso($usuario,$modulo,$elemento=0)
{
  $sql="select nivel from permisos where usuario=".$usuario->id." and modulo='$modulo' and elemento=$elemento ";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res))
    return (int)$row[nivel];
  else
    return 0;
}


function SetPermiso($usuario,$modulo,$nivel,$elemento=0)
{


  if ($nivel==0)
  {

    $p=GetPermiso($usuario,$modulo,$elemento);
    if ($p=100)
    {
      $sql="select count(*) as n from permisos  WHERE modulo='$modulo' and elemento=$elemento ";
      $n=mysql_fetch_array(mysql_query($sql));
      if ($n[n]==1) return false;
    }

    $sql="DELETE FROM permisos WHERE modulo='$modulo' and elemento=$elemento and usuario=".$usuario->id;
    //echo $sql;
    mysql_query($sql);
    return true;
  }

  $sql="insert into permisos (usuario,modulo,elemento,nivel) values
     (".$usuario->id.",'$modulo',$elemento,$nivel) ";

  if ($res=mysql_query($sql))
    return true;
  else
    return false;
}

function SetEmail($email,$modulo,$nivel,$elemento=0)
{
   return false;
  if ($nivel==0)
  {
    $sql="DELETE FROM permisos WHERE modulo='$modulo' and elemento=$elemento and usuario=".$usuario->id;
    mysql_query($sql);
    return true;
  }

  $sql="insert into permisos (usuario,modulo,elemento,nivel) values
     (".$usuario->id.",'$modulo',$elemento,$nivel) ";

  if ($res=mysql_query($sql))
    return true;
  else
    return false;
}

function PermisosInvitar($email,$modulo,$elemento,$nivel)
{
  global $titulopagina,$baseurl,$siteadmin;
  $sql="select id from usuarios where email=\"".addslashes($email)."\" ";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res))
  { 
     $sql="insert into permisos (usuario,modulo,elemento,nivel) values
        ($row[id],'$modulo',$elemento,$nivel) ";
      mysql_query($sql);
  }
  else
  {
    mysql_query("insert into permisos_pendientes (email,modulo,elemento,nivel)
                 values (\"".addslashes($email)."\",'$modulo',$elemento,$nivel) ");
    $pwd=rand(         10000000,                         99999999);
    mysql_query("insert into usuarios_peticiones(id,email,fecha,pwd)
                 values ( 0 , \"".addslashes($email)."\" , now() , $pwd )
    ");
    $id=mysql_insert_id();
    $c=new Correo();
    $c->to=$email;
    $c->from=$siteadmin;  
    $c->fromtxt=$titulopagina;
    $c->titulo="Proceso de Alta en $titulopagina";
    $txt="
    Se ha creado un acceso para usted en <strong>$titulopagina</strong>
    <br>
    Para completar su alta debe visitar el siguiente enlace:
          <br>
          <a href='$baseurl/usuarios/alta2/?pwd=$pwd-$id'>
             $baseurl/usuarios/alta2/?pwd=$pwd-$id
          </a>
    ";
    $c->enviar($txt);
    return true;
  }
}
/*
CREATE TABLE permisos_pendientes (
  email char(250),
  modulo char(50),
  elemento int(11),
  nivel int(11)
);
*/
?>