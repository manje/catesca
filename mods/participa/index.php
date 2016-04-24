<?php

importclass("comisiones");


$js[]="/js/tinymce/tinymce.min.js";
$js[]="/js/tinymce/jquery.tinymce.min.js";

$css[]="/js/datepicker/css/bootstrap-datepicker.min.css";
$js[] ="/js/datepicker/js/bootstrap-datepicker.min.js";
$js[] ="/js/datepicker/locales/bootstrap-datepicker.es.min.js";

$html->assign("css",$css);
$html->assign("js",$js);

function leerfecha($inicio,$hora,$minuto)
{
  $i=explode("/",$inicio);
  /* 0 d
     1 m
     2 a (+2000) */

  return mktime($hora,$minuto,0,$i[1],$i[0],$i[2]+2000);
}

mostrartpl("cabecera.bs.tpl");

if ($op=="add")
{
  if (!($isadmin)) exit;
  if (count($_POST)>3)
  {
    $errores=Array();
    if (strlen($_POST["titulo"])<3) $errores[]="Proporcione un título descriptitvo";
    $h=$_POST["tipo"];
    if (!(isset($HerramientasParticipacion[$h]))) $errores[]="Seleccione Tipo de Herramienta que desea crear";
    
    if (!(isset($_POST["inicio"])))
    {
      $a=leerfecha($_POST["finicio"],$_POST["ihora"],$_POST["iminuto"]);
      if ($a < time())  
        $errores[]="La fecha de inicio debe ser posterior";
      else
      {
        if (!(isset($_POST["fin"])))
        {
          $b=leerfecha($_POST["ffin"],$_POST["fhora"],$_POST["fminuto"]);
          if ($b<= $a)
             $errores[]="La fecha de inicio debe ser posterior";
        }
      }
    }
    if (count($errores)>0)
    {
      $html->assign("errores",$errores);
    }
    else
    {
      $data=$_POST;
      if (isset($_POST["inicio"]))
      {
        unset($data["inicio"]); 
        unset($data["fin"]);
      }
      else
      {
        $data["inicio"]=$a;
        if (isset($data["fin"]) )
          unset($data["fin"]);   
        else
          $data["fin"]=$b;
      }

      if (isset($data["verificado"])) $data["verificado"]=1; else $data["verificado"]=0;
      $data["creador"]=$usuario;

      $v=new Herramienta($data);
      if ($v->id > 0) 
      {
        if ($HerramientasParticipacion[$h]["postconf"]) 
          $html->assign("redireccion","/".$HerramientasParticipacion[$h]["modulo"]."/".$v->id."/postconf/");
        $html->assign("creada",$v);
      }
    }
  }

  $horas=Array();$minutos=Array();   
  $i=0;  
  while ($i < 24)
  {
    $horas[$i]=$i;
      $i++;
  }
  $i=0;
  while ($i < 60)
  {
    $minutos[$i]=$i;
    $i=$i+15;
  }
  if (count($_POST)==0)
  {
    $_POST["inicio"]="inicio";
    $_POST["fin"]="fin";
  }

  $html->assign("horas",$horas);
  $html->assign("minutos",$minutos);

  $html->assign("HerramientasParticipacion",$HerramientasParticipacion);
  $html->assign("comisiones",GetListComisiones());
  $html->assign("data",$_POST);
  $html->display("add.tpl");
}

mostrartpl("pie.bs.tpl");

