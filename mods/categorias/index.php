<?php


$js[]="/js/tinymce/tinymce.min.js";
$js[]="/js/tinymce/jquery.tinymce.min.js";

$html->assign("js",$js);


mostrartpl("cabecera.bs.tpl");
importclass("iniciativas");


$id=(int)$op;

if ($id > 0)
{
  if ($_POST[titulo])
  {
    mysql_query("update categorias set 
       titulo=\"".addslashes($_POST[titulo])."\",
       descripcion=\"".addslashes($_POST[descripcion])."\",
       nivel=\"".((int)$_POST[nivel])."\"
       where id=$id
    ");
    $id=0;
    echo mysql_error();
  }
}
if ($op=="add")
{
  if ($_POST[titulo])
  {
    mysql_query("insert into  categorias(id,titulo,descripcion,nivel)
    values (NULL,
       \"".addslashes($_POST[titulo])."\",
       \"".addslashes($_POST[descripcion])."\",
       ".((int)$_POST[nivel])." )

    ");
    $id=0;
    echo mysql_error();
  $op="";
  }
}

$c=new ControladorPropuestas();
$c=$c->GetCategorias(true);

$html->assign("categorias",$c);

$html->assign("op",$op);
$html->assign("id",$id);
  
if ($id>0)
{
  $c=$c[$id];
  $html->assign("editar",$c);
}

$html->display("index.tpl");
            
mostrartpl("pie.bs.tpl");
