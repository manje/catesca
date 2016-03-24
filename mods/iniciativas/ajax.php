<?php

if ($op=="votar")
{
  if ($usuario->id>0)
  {
    $cp=new ControladorPropuestas();
    $propuesta=new Propuesta((int)$_POST[id]);
    if ($propuesta->id > 0)
    {
    
      $voto=(int)$_POST[voto];
      if (($voto > 0) && ($voto<4))
      {
        $propuesta->votar($usuario,$voto);
        $out=Array();
        $out[up]=$propuesta->up;
        $out[down]=$propuesta->down;
        
        echo json_encode($out);
      }
    }
  }
}



if ($op=="colaborar")
{
  if ($usuario->id>0)
  {
    $cp=new ControladorPropuestas();
    $propuesta=new Propuesta((int)$_POST[id]);
    if ($propuesta->id > 0)
    {
    
      $propuesta->SetColaborador($usuario, ! ($propuesta->IsColaborador($usuario)) );
      echo json_encode($propuesta->IsColaborador($usuario));
    }
  }
}

