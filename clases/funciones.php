<?php

function fechaTOhace($t)
{
  $t=time()-$t;
  $hace="$t segundos";  
  if ($t > 59) 
  {
    $t=(int)($t/60);
    $hace="$t minutos";
    if ($t > 59)
    {
      if ($t > 59)
      {
        $t=(int)($t/60);
        $hace="$t horas";
        if ($t > 23) 
        { 
          $t=(int)($t/24);
          $hace="$t días";
          $d=$t;
          if ($t > 7)
          {
            $t=(int)($t/7);
            $hace="$t semanas";
            if ($t > 5) 
            {
              $t=(int)($d/30);
              $hace="$t meses";
            }
          }  
        }    
      }      
    }        
  }          
  return $hace;
}          

function html2text($html)
{
  $i=0;
  $out="";
  $txt=true;
  while ($i < strlen($html))
  {
    $c=$html[$i];
    if ($txt)
      if ($c=="<")
        $txt=false;
      else
        $out.=$c;
    else
      if ($c==">")
        $txt=true;
    $i++;
  }
  return $out;
}

function sololetras($txt)
{
  $a=strtolower($txt); 
  $b="";
  $i=0;
  while ($i < strlen($a))
  {
    $c=$a[$i];
    if ((ord($c)>= ord("a")) && (ord($c) <= ord("z"))) $b.=$c;
    $i++;
  }
  return $b;
}


function importclass($clase)
{
  global $home;
  $f= $home."/clases/".$clase.".php";
  if (file_exists($f))
    require_once($f);
  else
    if (file_exists($home."/mods/$clase/objeto.php"))
      require_once($home."/mods/$clase/objeto.php");
}
#
#function sql2array($sql)
#{
#  if ($res=mysql_query($sql))
#  {
#    $out=Array();
#    $i=0;
#    while ($row=mysql_fetch_array($res))
#    {
#      $out[$i]=$row;
#      $i++;
#    }
#    return $out;
#    
#  }
#  else
#    return false;
#}
#
#

function sololetrasynumeros($txt)
{
  $a=strtolower($txt); 
  $b="";
  $i=0;
  while ($i < strlen($a))
  {
    $c=$a[$i];
    if ((ord($c)>= ord("a")) && (ord($c) <= ord("z"))) $b.=$c;
    if ((ord($c)>= ord("0")) && (ord($c) <= ord("9"))) $b.=$c;
    $i++;
  }
  return $b;
}

#
#function getCache($elemento,$m=0,$s=0)
#{  
#  $id = md5($elemento);
#  if (($m==0) && ($s==0)) $s=30;
#  
#  if ($s==0) $tmp="00"; else $tmp="s";
#  $fecha=date("Y-m-d H:i:".$tmp, mktime(date("G"),date("i")-$m,date("s")-$s,date("m"),date("d"),date("Y")) );
#  $sql="SelecT txt FROM cache WHERE id='$id' and fecha > '$fecha' ";
#  $res=mysql_query($sql);
#  if ($row=mysql_fetch_array($res))
#    return unserialize($row[txt]);
#  else
#    return false;
#}
#  
#function putCache($elemento,$txt)
#{  
#  $id = md5($elemento);
#  mysql_query("update cache set txt=\"".addslashes(serialize($txt))."\" , fecha=now() where id='$id' ");
#  mysql_query("insert into cache(id,fecha,txt) values ('$id',now(),\"".addslashes(serialize($txt))."\") ");
#}
#
#

function conectar($parar=true)
{
  global $cnx,$bd_host,$bd_user,$bd_password,$bd_basededatos;
  @mysql_close($cnx);
  if ($cnx = mysql_pconnect ($bd_host,$bd_user,$bd_password))
  {
    if (!(@mysql_select_db ($bd_basededatos)))
    {
       echo "Sitio temporalmente inaccesiblea";
       exit;
    }
  }
  else
  {
    echo "Sitio temporalmente inaccesible";
    exit;
  }
}

function mostrartpl($tpl,$retornar=false,$dir=false)
{
  global $home,$mod,$html;
  if (!$dir) 
  {
    $html->template_dir = $home.'/tpl/';
    $html->compile_dir  = $home.'/smarty/templates_c/default/';
    $html->config_dir   = $home.'/smarty/configs/default/';
    $html->cache_dir    = $home.'/smarty/cache/default/';
  }
  else
  {
  $html->template_dir = $home.'/mods/'.$dir.'/tpl/';
  $html->compile_dir  = $home.'/smarty/templates_c/'.$dir.'/';
  $html->config_dir   = $home.'/smarty/configs/'.$dir.'/';
  $html->cache_dir    = $home.'/smarty/cache/'.$dir.'/';
  }

   
  
  if ($retornar)
    $txt=$html->fetch($tpl);
  else
    $html->display($tpl);
       
  $html->template_dir = $home.'/mods/'.$mod.'/tpl/';
  $html->compile_dir  = $home.'/smarty/templates_c/'.$mod.'/';
  $html->config_dir   = $home.'/smarty/configs/'.$mod.'/';
  $html->cache_dir    = $home.'/smarty/cache/'.$mod.'/';
  if ($retornar) return $txt;
}

function directorio($pwd)
// crea directorio si no existe
{
  if (!(file_exists($pwd))) 
  {
    if (!(@mkdir($pwd)))
       { echo "no existe $pwd  ni lo puedo crear"; exit;}
  }
}

function golog($txt,$extra=false)
{
  global $usuario;
  /*
  CREATE TABLE registro(
    fecha timestamp,
    usuario int(11),
    ip char(15),
    proxy varchar(60) default NULL,
    txt varchar(250),
    extra varchar(250) default NULL
  );
  
  */
  if ($extra) 
  {
    $c=",extra";
    $w=" , \"".addslashes($extra)."\" ";
  }
  else
  {
    $c="";
    $w="";
  }
  if ($_SERVER["HTTP_X_FORWARDED_FOR"] != "") 
  {
    $c.=",proxy";
    $w.=",\"".addslashes($_SERVER["HTTP_X_FORWARDED_FOR"])."\" ";
  }
    
  $sql="insert into registro (fecha,usuario,ip,txt$c)
  VALUES (now(),".$usuario->id.",\"".addslashes($_SERVER["REMOTE_ADDR"])."\",\"".addslashes($txt)."\"$w ) 
  
  ";
  mysql_query($sql);
  

}



?>