<?php


if ($op=="add")
{
  if ($usuario->id==0) exit;
  $com=new Comentarios($_POST[cmod],(int)$_POST[cele],(int)$_POST[padre]);
  if (strlen($_POST[txt])>10) $com->add($usuario,false,$_POST[txt]);
  echo json_encode(true);
}