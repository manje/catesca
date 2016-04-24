<?php
header("Content-Type: application/javascript");

$op=sololetras($op);

$f=$home."/mods/$op/javascript.js";
if (file_exists($f))
{
 echo file_get_contents($f);
}

$subop=sololetras($subop);
$f=$home."/mods/$op/$subop.js";
if (file_exists($f))
{
 echo file_get_contents($f);
}

