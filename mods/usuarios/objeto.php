<?php
importclass("correo");
importclass("permisos");

function GetUsuarioByEmail($email)
{
  $sql="select id from usuarios where      email=\"".addslashes($email)."\" ";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res))
  {
    return new Usuarios(false,$row[id]);
  }
  else
    return false;
}


class Usuarios
{

  function Usuarios($intentarautentificar=false,$id=0)
  {
    $this->id=0;
    if ($intentarautentificar) $this->autentificar();
    if ($id > 0)
    {
      $sql="select email,nick,password(pwd) as pwd from usuarios where id = $id";
      $res=mysql_query($sql);echo mysql_error();
      if ($row = mysql_fetch_array($res))
      {
          $this->id=$id;
          $this->nick=$row[nick];
          $this->email=$row[email];
          $this->id=$id;
          $this->ComprobarVerificacion(1);
      }
    }
    if ($this->id > 0)
    {  
      $this->checkFirma();
    }

    return true;
  }
  
  function checkFirma()
  {
    $sql="select * from firmas where email=\"".addslashes($this->email)."\" ";
    $res=mysql_query($sql);
    if ($row=mysql_fetch_array($res))
    {
      mysql_query("insert into colaboradores (id,nombre,apellidos,ocupacion,movil,ciudad,territorio,mailing,moviling,borrado)
      values
      (".$this->id.",
      \"".addslashes($row[nombre])."\",
      \"".addslashes($row[apellidos])."\",
      \"".addslashes($row[ocupacion])."\",
      \"".addslashes($row[movil])."\",
      \"".addslashes($row[ciudad])."\",
      \"".addslashes($row[territorio])."\",
      \"".addslashes($row[mailing])."\",
      \"".addslashes($row[moviling])."\",
      \"".addslashes($row[borrado])."\" ) ");
      $sql="select * from intereses_firmas where firmante=$row[id]";
      $res=mysql_query($sql);
      while ($rowx=mysql_fetch_array($res))
      {
        mysql_query("insert into intereses (usuario,interes) values (".$this->id.",'$rowx[interes]') ");
        
      }
      mysql_query("delete from firmas where email=\"".addslashes($this->email)."\" ");
      mysql_query("delete from intereses_firmas where firmante=$row[id]");
    }
  }
  
  function GetColaborador()
  {
    global $externos,$distritos;
    $sql="select * from colaboradores where id=".$this->id;
    $res=mysql_query($sql);
    if ($row=mysql_fetch_array($res))
    {
      $i=$row[territorio];
      if ($row[ciudad])
        $row[territoriotxt]=$distritos[$i];
      else
        $row[territoriotxt]=$externos[$i];
      $sql="select interes from intereses where usuario=".$this->id;
      $res=mysql_query($sql);
      $intereses=Array();
      while ($r=mysql_fetch_array($res)) $intereses[]=$r[interes];
      $this->colaborador=$row;
      $this->intereses=$intereses;
      return Array("colaborador"=>$colaborador,"intereses"=>$intereses);
    }
    else
      return false;
  
  }
  
  function AltaColaborador($post)
  {
    if ($d[lugarresidencia]==1)
    {
      $c=1;
      $t=$d[distrito];
    }
    else
    {
      $c=0;
      $t=$d[residencia];
    }
    
    if ($_POST[okmail]==1) $ma=1; else $ma=0;
    if ($_POST[okmovil]==1) $mo=1; else $mo=0;

    $sql=("insert into colaboradores (id,nombre,apellidos,ocupacion,movil,ciudad,territorio,mailing,moviling)
                 values (".$this->id.",    
                 \"".addslashes($post[nombre])."\",
                 \"".addslashes($post[apellidos])."\",
                 \"".addslashes($post[ocupacion])."\",
                 \"".addslashes($post[movil])."\",
                 $c,
                 \"".addslashes($t)."\",$ma,$mo)
    ");  
    mysql_query($sql);

  }
  
  function ComprobarVerificacion($x=false)
  {
          $this->dataverificacion=$this->Verificar();
          if ($this->dataverificacion)
          {
            $this->verificado=($this->dataverificacion[verificado]==1);
              
          }
          else
            $this->verificado=false;
  
  }
  
  function GetFechaAlta()
  {
    $sql="select fecha from usuarios where id = ".$this->id;
    $res=mysql_query($sql);
    if ($row=mysql_fetch_array($res))
      return $row[fecha];
    else
      return false;
  }
  
  function peticion($email)
  {
    global $baseurl,$ciudad,$siteadmin,$titulopagina;
    mysql_query("delete from usuarios_peticiones where fecha < (now() - interval 1 day) ");
    $sql="select count(*) as n from usuarios_peticiones where 
        email=\"".addslashes($email)."\"
    ";
    $res=mysql_query($sql);
    $row = mysql_fetch_array($res);
    if ($row[n]>0) return false;

    $sql="select count(*) as n from usuarios where 
        email=\"".addslashes($email)."\"
    ";
    $res=mysql_query($sql);
    $row = mysql_fetch_array($res);
    if ($row[n]>0) return false;

    $pwd=rand(
        10000000,
        99999999);
    mysql_query("insert into usuarios_peticiones(id,email,fecha,pwd)
      values ( NULL , \"".addslashes($email)."\" , now() , $pwd )
    ");
    $id=mysql_insert_id();
    $c=new Correo();
    $c->to=$email;
    $c->from=$siteadmin;
    $c->fromtxt=$titulopagina;
    $c->titulo="Confirmación de Alta en $titulopagina";
    $txt="Para completar su alta debe visitar el siguiente enlace:
    <br>
    <a href='$baseurl/usuarios/alta2/?pwd=$pwd-$id'>
       $baseurl/usuarios/alta2/?pwd=$pwd-$id
    </a>
    ";
    $c->enviar($txt);
    return true;
  }

  function preconfirmar($pwd)
  {
    $p=explode("-",$pwd);
    $p[0]=(int)$p[0];
    $p[1]=(int)$p[1];
    $sql="select email from usuarios_peticiones where 
    id=$p[1] and pwd=$p[0]
    ";
    $res=mysql_query($sql);echo mysql_error();
    if ($row = mysql_fetch_array($res))
      return $row[email];
    else
      return false;
  }

  function confirmar($pwd,$nick,$contra)
  {
    $p=explode("-",$pwd);
    $p[0]=(int)$p[0];
    $p[1]=(int)$p[1];
    $sql="select * from usuarios_peticiones where 
    id=$p[1] and pwd=$p[0]
    ";
    $res=mysql_query($sql);echo mysql_error();
    if ($row = mysql_fetch_array($res))
    {
      $sql="INSERT INTO usuarios (id,nick,email,pwd,fecha)
        values(NULL,\"".addslashes($nick)."\",\"".addslashes($row[email])."\",password(\"".addslashes($contra)."\"),now())
      ";
      mysql_query($sql);
      $idu=mysql_insert_id();
      if ($idu==1)
      {
        SetPermiso(new Usuarios(false,$idu),"admin",100);
      }
      $this->entrar($row[email],$contra);
      return true;
    }
    else
      return false;
  }
  
  function autentificar($cookie="no")
  {
    if ($cookie=="no") 
    {
      if (isset($_COOKIE['usuario']))
        $cookie=$_COOKIE['usuario'];
      else
        $cookie="no";
    }	
    if ($cookie!="no")
    {
      $a=explode("-",$cookie);
      $id=(int)$a[0];
      $sql="select email,nick,pwd from usuarios where id = $id ";
      $res=mysql_query($sql);echo mysql_error();
      if ($row = mysql_fetch_array($res))
      {
        if (md5($row[pwd])==$a[1])
        {
          $this->id=$id;
          $this->nick=$row[nick];
          $this->email=$row[email];
          $this->ComprobarVerificacion(2);
          $cookie=$id."-".md5($row[pwd])."-".$a[2];
          if ($a[2])
            $t=time()+30*24*60*60;
          else
            $t=0;
          setcookie("usuario",$cookie,$t,"/",$_SERVER[HTTP_HOST]);
          mysql_query("update usuarios set ultimoacceso=now() where id=$id");
          mysql_query("insert into entradausuario (usuario,fecha) values (".$this->id.",'".date("Y-m-d")."')");
          $this->acceso();
          return true;
        }
      }
    }
    $this->id=0;
    return false;
  }
  
  function salir()
  {
     global $baseurl;
     setcookie ( "usuario","",0,"/",$_SERVER[HTTP_HOST]);
     header("Location: $baseurl");
     exit;
  }
  
  function entrar($nick,$pwd,$permanente=false)
  {
     global $baseurl;
     $sql="select id,pwd,nick,email from usuarios where 
       email = \"".addslashes($nick)."\" and
       pwd = password(\"".addslashes($pwd)."\")  ";
     $res=mysql_query($sql);echo mysql_error();
     if (!($row = mysql_fetch_array($res)))
     {
       $sql="select id,pwd,nick,email from usuarios where 
         nick = \"".addslashes($nick)."\" and
         pwd = password(\"".addslashes($pwd)."\")  ";
       $res=mysql_query($sql);echo mysql_error();
       if (!($row = mysql_fetch_array($res)))
       {
         return false;
       }
     }

     if ($a[permanente])
       $t=time()+30*24*60*60;
     else
       $t=0;
                                                 
     setcookie("usuario",   $row[id]."-".md5($row[pwd])."-".$permanente     ,$t,"/",$_SERVER[HTTP_HOST]);
          
     $this->id=$row[id];
     $this->nick=$row[nick];  
     $this->email=$row[email];
     $this->ComprobarVerificacion(3);
                                                  

     #header("Location: $baseurl");
     $this->acceso();
  }
  
  function acceso()
  {
    mysql_query("update usuarios set ultimoacceso=now() where id=".
    $this->id);
    return true;
  }
  
  function recordar()
  {
    global $bd_password,$titulopagina,$baseurl,$siteadmin;
    $md=$bd_password.$this->id.$this->nick.$this->email.date("j-m-y");
    $md=md5($md);
    $url=$baseurl."/usuarios/recordar/go/?md=".$this->id."-$md";
    $c=new Correo();
    $c->to=$this->email;
    $c->from=$siteadmin;
    $c->fromtxt=$titulopagina;
    $c->titulo="Recordatorio de contraseña para $titulopagina";
    $txt="Para cambiar su contraseña debe visitar el siguiente enlace:
    <br>
    <a href='$url'>
       $url
    </a>
    ";
    $c->enviar($txt);
    return true;
    
    
  }
  
  function md($mdin)
  {
    global $bd_password,$titulopagin,$baseurl;
    $md=$bd_password.$this->id.$this->nick.$this->email.date("j-m-y");
    $md=md5($md);
    return ($md==$mdin);
  
  }
  
  function setpwd($pwd)
  {
    mysql_query("update usuarios set pwd=password(\"".addslashes($pwd)."\") where id=".$this->id);
  }
  
  function setnick($nick)
  {
    mysql_query("update usuarios set nick=\"".addslashes($nick)."\" where id=".$this->id);
    $this->nick=$nick;
  }
  
  function setfoto($fichero)
  {
    $ant=GetMediaFromModulo("usuario",$this->id);
    $m=CrearMediaFromImagen($fichero,"usuario",$this->id);
    if ($m && $ant) $ant->delete();
  }
  

  
  function Verificar()
  {
    $sql="select * from verificaciones where usuario=".$this->id;
    $res=mysql_query($sql);
    if ($row=mysql_fetch_array($res))
    {
      if ($row[administrador]!=$this->id) $row[administrador]=new Usuarios(false,$row[administrador]);
      $row[data]=unserialize($row[data]);
      return $row;
    }
    return false;
  }
  
  function InicioVerificacion($tipo,$documento,$data=false)
  {
    mysql_query("insert into verificaciones (usuario,tipo,documento,solicitada,data)
    values (".$this->id.",'$tipo',\"".addslashes($documento)."\",now(),\"".addslashes(serialize($data))."\" ) ");
    
    echo mysql_error();
  }
  
}
