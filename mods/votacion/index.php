<?php

$js[]="/js/jquery-sortable.js";
$html->assign("js",$js);

mostrartpl("cabecera.bs.tpl");

$v=new Votacion((int)$op);

if (!($v->id)) exit;

if (!($v->visible($usuario))) exit;

$html->assign("votacion",$v);

if (!isset($subop))
{
  $html->assign("participacion",$v->Participacion());
  $html->display("votacion.tpl");
}


if ($subop=="votar")
{
  if ($usuario->id==0) exit;
  if ($data=$v->UsuarioHaVotado($usuario))
  {  
    $html->assign("yahavotado",$data);
    $html->display("yahavotado.tpl");
  }
  else
  {
    $voto=$v->GetVoto($usuario);
    $valido=true; 
    foreach ($v->datos["preguntas"] as $k => $p)
    {
      if (in_array($p["mecanica"],Array("varias","preferente")))
      {
        if ($p["minop"]>count($voto[$k])) $valido=false;
      }
    }
    $html->assign("votacionvalida",$valido);
  
  
    $html->assign("voto",$voto);
    if (isset($c[3])) $paso=$c[3];
    if ($paso=="prg")
    {
      $idp=(int)$c[4];
      if (isset($v->datos["preguntas"][$idp]))
      {
        $prg=$v->datos["preguntas"][$idp];
        
        
        
        $html->assign("pregunta",$prg);
        $html->assign("idp",$idp);
        $html->assign("voto",json_encode($voto[$idp]));
  
        $html->assign("opcionesjson",json_encode( $v->datos["preguntas"][$idp]["opciones"] ));
        $html->display("vota.".$prg["mecanica"].".tpl");
      }
    }
    
  
  
    if (($paso=="confirmar") && ($valido))
        $html->display("confirmacion.tpl");

    if (($paso=="final") && ($valido))
    {
        $codigo=$v->Votar($usuario);
        $html->assign("codigo",$codigo);
        $html->display("final.voto.tpl");
    }

    if (!isset($paso))
      $html->display("votar.preguntas.tpl");

  }

}

if ($subop=="postconf")
{
  if ($v->creador->id!=$usuario->id) exit;
  $html->assign("ocultarformadd",true);
  if ($c[3]=="addp")
  {
    $err=Array();
    $_POST["mecanica"]=sololetras($_POST["mecanica"]);
    $_POST["escrutinio"]=sololetras($_POST["escrutinio"]);
    $_POST["minop"]=(int)$_POST["minop"];
    $_POST["maxop"]=(int)$_POST["maxop"];
    
    if (strlen($_POST["titulo"])<3) $err[]="Introduzca título";
    if (!(in_array($_POST["mecanica"],Array("una","varias","preferente"))))
       $err[]="Seleccione la mécanica de voto";
    if (!(in_array($_POST["escrutinio"],Array("totales","vut","borda"))))
       $err[]="Seleccione el método de escrutinio";
    
    if  ( 
          ($_POST["mecanica"]!="preferente")
        && 
          (in_array($_POST["escrutinio"],Array("vut","borda")))
        )
      $err[]="Es necesario una mecánica de voto ordenado para usar el recuento VUT o Borda";
    if (  ($_POST["minop"]>$_POST["maxop"]) && ( $_POST["mecanica"]>1  ))
      $err[]="El número máximo de opciones elegibles no puede ser menos que el mínimo";
    
    if ($_POST["escrutinio"]=="vut")
    {
      if (!(in_array($_POST["tipovut"],Array("numero","ranking"))))
      {
        $err[]="Elija que tipo de resultado quiere que genere el VUT";
      }
      else
      {
        if ($_POST["tipovut"]=="numero")
        {
          $_POST["numvut"]=(int)$_POST["numvut"];
          if ($_POST["numvut"]<1) $err[]="Elija el número de opciones a elegir mediante el método VUT";
        }
      }
    }

    if (count($err)>0)
    {
      $html->assign("errores",$err);
      $html->assign("ocultarformadd",false);
      $html->assign("post",$_POST);
    }
    else
    {
      // Añadir Pregunta
      $opciones=Array();
      if ($_POST["op_descripcion"]) $opciones[]="descripcion";
      if ($_POST["op_img"]) $opciones[]="imagen";
      if ($_POST["op_file"]) $opciones[]="file";
      $prg=Array(
        "titulo"=>$_POST["titulo"],
        "descripcion"=>$_POST["descripcion"],
        "mecanica"=>$_POST["mecanica"],
        "escrutinio"=>$_POST["escrutinio"],
        "opciones"=>$opciones,
        "minop"=>$_POST["minop"],
        "maxop"=>$_POST["maxop"]
      );
      if ($prg["escrutinio"]=="vut")
      {
        $prg["tipovut"]=$_POST["tipovut"];
        if ($prg["tipovut"]=="numero") $prg["numvut"]=$_POST["numvut"];
      }
      $v->addPregunta($prg);
    }
    unset($c[3]);
  }
  if ($c[3]=="opciones")
  {
    $idp=(int)$c[4];
    if (isset($v->datos["preguntas"][$idp]))
    {
      if (($c[5]=="add") && (strlen($_POST["titulo"])>3)  )  
      {
        $i=strtoupper(dechex(rand(hexdec("1000"),hexdec("FFFF"))));
        while (isset($v->datos["preguntas"][$idp]["opciones"][$i])) $i=strtoupper(dechex(rand(hexdec("1000"),hexdec("FFFF"))));
        $v->datos["preguntas"][$idp]["opciones"][$i]=Array("titulo"=>$_POST["titulo"]);
      }
      if ($c[5]=="del")
      {
        $i=dechex((int)hexdec($c[6]));
        unset($v->datos["preguntas"][$idp]["opciones"][$i]);
      }
      $html->assign("idp",$idp);
      $html->assign("opciones",$v->datos["preguntas"][$idp]["opciones"]);
      $html->display("edita.opciones.tpl");
      if (in_array($c[5],Array("add","del"))) $v->GuardarDatos();
    }
  }
  
  $html->assign("votacion",$v);
  
  if (!(isset($c[3])))
  {
    if (count($_POST)==0)
    {
      $_POST["minop"]=0;
      $_POST["maxop"]=1000;
      $html->assign("post",$_POST);
    }
    $html->display("postconf.tpl");
  }

}

if ($subop=="escrutinio")
{
  // hay que controlar que el escrutinio se vea cuando esté finalizada
  $e=$v->Escrutinio();
  $html->assign("escrutinio",$e);
  $html->display("escrutinio.tpl");
  echo "<pre>".print_r($e,true)."</pre>";
}


mostrartpl("pie.bs.tpl");
