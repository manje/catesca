<?php


$js[]="/js/tinymce/tinymce.min.js";
$js[]="/js/tinymce/jquery.tinymce.min.js";
$js[]="/js/comentarios/?".rand(0,1000);
$html->assign("js",$js);

importclass("comentarios");

mostrartpl("cabecera.bs.tpl");

  
  $esmiembro=false;
  $sql="select count(*) as n from permisos where  modulo='comision' and usuario=".$usuario->id;
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  if ($row[n]>0) $esmiembro=true;
  $html->assign("esmiembro",$esmiembro);
  
  $cp=new ControladorPropuestas();
  $cp->usuario=$usuario;
  $cats=$cp->GetCategorias($esmiembro);
  $html->assign("categorias",$cats);
    


if ($op=="add")
{

  if ($usuario->id==0) exit;

  $msg="";
  $html->assign("categorias",$cats);
  if ($subop=="go")
  {
    $idc=(int)$_POST[categoria];
    $html->assign("titular",$_POST[titular]);
    $html->assign("categoria",$_POST[categoria]);
    $html->assign("texto",$_POST[texto]);
    if (strlen($_POST[titular])<3) $msg="Use un título que describa con pocas palabras su propuesta";
    if (strlen($_POST[texto])<20) $msg="Redacte un texto describa su propuesta";
    
    if ($idc==0)
      $msg="Seleccione la categoría adecuada a su propuesta";
    else
    {
      if (!(isset($cats[$idc]))) $msg="Error 2334983".print_r($cats,true)." -- $idc -- ";
    }
    if (strlen($_POST[titular])>240) $msg="Use un título más corto";
    if ($msg=="")
    {
      // meter la categoria
      $_POST[categoria]=$idc;
      $_POST[usuarioid]=$usuario->id;
      $p=new Propuesta($_POST);
      $c[2]=$p->id;
      $op="p";
    }
    else
    {
      $html->assign("val",$_POST);
      $html->assign("msg",$msg);
      $html->display("add.tpl");
    }
  }
  else
    $html->display("add.tpl");
}

if ($op=="categoria")
{
  $cp->categoria=(int)$subop;
  $html->assign("categoria",$cats[$subop]);
  unset($op);
}

if (!$op)
{
  if (isset($_GET[orden]))
    $orden=$_GET[orden];
  else
    $orden="puntos";
  $cp->orden=$orden;

  $p=$cp->GetPropuestas();
  
  $pag=(int)$_GET[pag];
  $num=5;
  $pags=(int)(count($p)/$num);
  if (($pags*$num)<count($p) ) $pags++;
  $html->assign("paginas",$pags-1);

  $a=$pag*$num;
  $b=$pag*$num+$num-1;
  $i=$a;
  $pp=Array();
  while (($i <=$b) && ($i < count($p)))
  {
    $pp[]=$p[$i];
    $i++;
  }
  
  $html->assign("paga",$pag-1);
  $html->assign("pags",$pag+1);
  $html->assign("pag",$pag);
  $html->assign("orden",$orden);
  $html->assign("propuestas",$pp);
  $html->display("index.tpl");
      
}

if ($op=="p")
{
  $p=new Propuesta((int)$c[2]);
  if ($p->id==0) exit;
  $html->assign("propuestas",Array($p));
  $c=new Comentarios("propuesta",$p->id);
  #$c->add($usuario,"hoal","hotltxt");
  $html->assign("comhtml",$c->get_html());
  $html->assign("IsColaborador",$p->IsColaborador($usuario));

  $html->display("verpropuesta.tpl");
}

if ($op=="x")
{
  exit; // esto es un editor de categorias totalmente inseguro
  $id=(int)$_GET[id];
  if ($id>0)
  {
    mysql_query("update categorias set 
        titulo=\"".addslashes($_POST[titulo])."\" ,
        descripcion=\"".addslashes($_POST[descripcion])."\" 
        where id=$id ");
    $cats=$cp->GetCategorias();
  }
  foreach ($cats as $c)
  {
    echo "
      <form action='/propongo/x/?id=$c[id]' method=post>
      <input type=text name=titulo value='$c[titulo]'>
      <textarea name=descripcion>$c[descripcion]</textarea>
      <input type=submit>
      </form>
      <hr>
    
    ";
  }

}

mostrartpl("pie.bs.tpl");
