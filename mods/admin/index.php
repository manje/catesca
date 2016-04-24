<?php
mostrartpl("cabecera.tpl");

echo "<h2>Verificadores</h2>";
foreach ($verificaciones as $k=>$v)
{
  echo "<a href='/adminusuarios/$k/'>$v[titulo]</a><br>";
}
mostrartpl("pie.tpl");

?>