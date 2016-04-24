<?php


header('Content-Type: application/json; charset=utf-8', true,200);

$mod=sololetras($op);
$op=$subop;
$subop=$c[3];

importclass($mod);

$f=$home."mods/$mod/ajax.php";

$html->template_dir = $home.'/mods/'.$mod.'/tpl/';
$html->compile_dir  = $home.'/smarty/templates_c/'.$mod.'/';
$html->config_dir   = $home.'/smarty/configs/'.$mod.'/';
$html->cache_dir    = $home.'/smarty/cache/'.$mod.'/';


if (file_exists($f))
  require($f);


