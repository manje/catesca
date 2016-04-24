<?php


if ($op=="contestarpregunta")
{
  $v=new Votacion((int)$_POST["votacion"]);
  $idp=(int)$_POST["pregunta"];
  if (($v->Visible($usuario)) && ($v->activa))
  {
    if (isset($v->datos["preguntas"][$idp]))
    {
      $votos=json_decode($_POST[voto]);
      $vot=Array();
      foreach ($votos as $vv)
      {
        $cod=explode("_",$vv);
        $cod=$cod[1];
        if (isset($v->datos["preguntas"][$idp]["opciones"][$cod]))
        {
          $vot[]=$cod;
        }
      }
      $vt=$v->GetVoto($usuario);
      $vt[$idp]=$vot;
      $v->PutVoto($usuario,$vt);
    }
    
  }



echo json_encode(true);

}