<?php
/*
 (c) 2008 Manuel J. Roman Estrade manje@manje.net

drop table comentarios;
CREATE TABLE comentarios (
  id int(11) NOT NULL auto_increment,
  autor int(11) NOT NULL,
  modulo char(15) NOT NULL,
  elemento int(11) NOT NULL,
  padre int(11) NOT NULL,
  puntos int(11) NOT NULL default 1,
  fecha datetime,
  titulo varchar(250),
  texto text,
  ip char(35),
  PRIMARY KEY  (id)
);

*/

class Comentarios
{

  var $modulo,$elemento,$padre;

  function Comentarios($modulo="noticias",$elemento=0,$padre=0)
  {
    $this->modulo=$modulo;
    $this->elemento=$elemento;
    $this->padre=$padre;
    return true;
  }
  
  function get_ip()
  {
    global $HTTP_SERVER_VARS; 
    if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"] != "")
      return $HTTP_SERVER_VARS["REMOTE_ADDR"]."/".$HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
    else
     return $HTTP_SERVER_VARS["REMOTE_ADDR"];
  }
                     
  function add($usuario,$titulo,$texto)
  {
    global $kdospuntos,$kzero;
    $puntos=0;
      
    $sql="insert into comentarios 
      (id,autor,modulo,elemento,padre,puntos,fecha,titulo,texto,ip)
      values (0,".$usuario->id.",'".
      $this->modulo
      ."',".
      $this->elemento
      .",".
      $this->padre
      ." , $puntos , now() , \"".
      addslashes($titulo)
      ."\" , \"".
      addslashes($texto)
      ."\" , \"".addslashes($this->get_ip())."\" )
    ";
    return mysql_query($sql);
  }

  function get_num()
  {
    $sql="select count(*) as n from comentarios where modulo='".$this->modulo."' and elemento=".$this->elemento;
    if ($res=mysql_query($sql))
    {
      if ($row=mysql_fetch_array($res))
      {
        return $row[n];
      }
    }
    return false;
  }

  function get_comentarios_rec(&$aux,$margen=0,$padre=-1)
  {
    if ($padre==-1) $padre=$this->padre;
    if ($aux==1) $aux=Array();

    $sql="SELECT usuarios.id as autorid , usuarios.nick as autor,
    comentarios.titulo , comentarios.texto , comentarios.fecha ,unix_timestamp(comentarios.fecha) as fechahace , comentarios.id ,
    comentarios.padre
    
    FROM comentarios,usuarios
    WHERE comentarios.autor=usuarios.id and
          comentarios.elemento = ".$this->elemento." and
          comentarios.modulo ='".$this->modulo."'   and
          padre=$padre";
    $res=mysql_query($sql);
    echo mysql_error();
    while ($row=mysql_fetch_array($res))
    {
      $id=$row[id];
      $row[margen]=$margen;
      $row[fechahace]=fechaTOhace($row[fechahace]);
      $row[usuario]=new Usuarios($row[autorid]);
      $aux[$id]=$row;
      
      $this->get_comentarios_rec($aux,$margen+1,$id);
    }
    return $aux;
  }
  
  function get_comentarios()
  {
    $aux=1;
    return $this->get_comentarios_rec($aux);
  }


  function get_comentario($id)
  {
    $sql="select * from comentarios where id=$id";
    if ($res=mysql_query($sql))
      if ($row=mysql_fetch_array($res))
         return $row;
    return false;
  } 
  
  function get_html()
  {
    global $html;
    $html->assign("cmod",$this->modulo);
    $html->assign("cele",$this->elemento);
    $out="";
   
    $c=$this->get_comentarios();
    $out=count($c);
    foreach ($c as $cc) {
      $html->assign("comentario",$cc);
      $out.=mostrartpl("uno.tpl",true,"comentarios");
    }
    $out.=mostrartpl("comentar.tpl",true,"comentarios");
    return  $out;
  }

}


