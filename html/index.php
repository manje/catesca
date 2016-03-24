<?php

$baseurl= "http://".$_SERVER[HTTP_HOST];
require("../config.php");
include_once("../clases/funciones.php");
conectar();
importclass("usuarios");
$usuario = new Usuarios(true);
importclass("smarty");


if ($_POST[introemail])
  $usuario->entrar($_POST[introemail],$_POST[intropwd]);


    
$html=new Plantilla();

if ($_POST[introemail])
  $html->assign("introemail",$_POST[introemail]);



$permisos=GetPermiso($usuario,"admin");
$isadmin=(100==$permisos);
unset($op);unset($subop);unset($mod);
if (isset($_GET[carpeta]))
{
  $c=explode("/",$_GET[carpeta]);
  if (count($c)>-1) $mod=$c[0];
  if (count($c)> 0) $op=$c[1];
  if (count($c)> 1) $subop=$c[2];
}
if (isset($_POST[mod])) $mod=$_POST[mod];
if (isset($_GET[mod])) $mod=$_GET[mod];
if (isset($_POST[op])) $op=$_POST[op];
if (isset($_GET[op])) $op=$_GET[op];
if (isset($_POST[subop])) $subop=$_POST[subop];
if (isset($_GET[subop])) $subop=$_GET[subop];

$mod=sololetras($mod);
$html->assign("isadmin",$isadmin);

if (isset($op)) $html->assign("op",$op);
if (isset($subop)) $html->assign("subop",$subop);
        

if (
   (!file_exists($home."/mods/$mod"))
   ||
   ( strlen($mod)<2)
   )
   $mod="index";
$html->assign("mod",$mod);
directorio($home.'/mods/'.$mod.'/tpl/');
directorio($home.'/smarty/templates_c/'.$mod.'/');
directorio($home.'/smarty/configs/'.$mod.'/');
directorio($home.'/smarty/cache/'.$mod.'/');

$html->template_dir = $home.'/mods/'.$mod.'/tpl/';
$html->compile_dir  = $home.'/smarty/templates_c/'.$mod.'/';
$html->config_dir   = $home.'/smarty/configs/'.$mod.'/';
$html->cache_dir    = $home.'/smarty/cache/'.$mod.'/';
$js=Array();$css=Array();
// eskeleton";
#if( ($mod!="propongo") &&  ($mod!="usuarios"))
if (false)
{
$css[]="/css/skeleton/base.css";
$css[]="/css/skeleton/layout.css";
$css[]="/css/skeleton/skeleton.css";
$css[]="/css/skeleton/tables.css";
$css[]="/css/style.css";
}
else
{


}
/*
// JQUERY Y CUSTOM THEME
$css[]="/js/jquery-ui-1.11.4.custom/jquery-ui.css";
$js[]="/js/jquery-ui-1.11.4.custom/external/jquery/jquery.js";
$js[]="/js/jquery-ui-1.11.4.custom/jquery-ui.js";
*/

// notify
#$js[]="/js/jq/notify/jquery.notice.js";
#$css[]="/js/jq/notify/jquery.notice.css";

// mis estilos

        
if (file_exists($home."/mods/$mod/javascript.js"))
{
  $js[]="/js/$mod/?".rand(0,2222222);
}
$html->assign("js",$js);
$html->assign("css",$css);

importclass($mod);
require($home."mods/init.php");
require($home."mods/$mod/index.php");

?>