<?php

function GetListComisiones()
{
  $out=Array();
  $sql="select id,titulo from comisiones where borrado=0";
  $res=mysql_query($sql);
  while ($row=mysql_fetch_array($res))
  {
    $id=$row["id"];
    $out[$id]=$row["titulo"];
  }
  return $out;
  
}