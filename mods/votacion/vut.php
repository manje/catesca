<?php

/*

  $v=new VotoVUT();
  $v->NuevaPapeleta(Array(3,5,2,1,6,4));

  // Matemáticas de precisión arbitraria BCMath
  http://php.net/manual/es/book.bc.php


*/

class VotoVUT
{

  var $votos=Array();

  function VotoVut()
  {}
  
  function NuevaPapeleta($votos,$num=1)
  // Añade una nueva papeleta/voto
  {
    $cod="";
    foreach($votos as $v) $cod.="-".$v;
    if (isset($this->votos[$cod])) 
    {
      $this->votos[$cod]["num"]=bcadd($this->votos[$cod]["num"],$num);
    }
    else
    {
      $v=Array();
      $v["num"]=(string)$num;
      $v["papeleta"]=$votos;
      $this->votos[$cod]=$v;
    }  
  }
  
  function TotalVotos()
  {
    $num=0;
    foreach ($this->votos as $v)
    $num=bcadd($num,$v["num"]);
    return $num;
  }
  
  function CocienteDroop($n)
  {
    return (int)(1+($this->TotalVotos()/ ( $n+1) ) );
  }
  
  function Candidatos()
  {
    $candidatos=Array();
    foreach ($this->votos as $pap)
    {
      foreach ($pap["papeleta"] as $v)
      {
        if (!(in_array($v,$candidatos)))
          $candidatos[]=$v;
      }
    }
    return $candidatos;
  }

  function Condorcet()
  {
    $candidatos=$this->Candidatos();
    // vamos a buscar si alguno gana a todos
    $i=0;
    while ($i < count($candidatos))
    {
      $j=0;
      $ganador=true;
      while ($j < count($candidatos))
      {
        $a=$candidatos[$i];
        $b=$candidatos[$j];
        if ($a != $b)
        {
          $ganadora=0;$ganadorb=0;
          foreach ($this->votos as $pap)
          {
            $ii=0;
            while ($ii < count($pap["papeleta"]))
            { 
              if ($pap["papeleta"][$ii]==$a)
              {
                $ganadora=bcadd($ganadora,$pap["num"]);
                break;
              }
              if ($pap["papeleta"][$ii]==$b)
              {
                $ganadorb=bcadd($ganadorb,$pap["num"]);
                break;
              }
              $ii++;
            }
          }
          if (bccomp($ganadora,$ganadorb)<1) $ganador=false;
        }
        $j++;
      }
      if ($ganador) return $a;
      $i++;
    }
    return false;
  }

  function OrdenarRecuento($a,$b)
  {
    #$x=bccomp($a[votos],$b[votos])*(-1);
    if ($a[votos]==$b[votos]) 
      $x=0;
    else
      $x=($a[votos]>$b[votos]) ? -1 : 1;

    if($x==0)
    {
      $coda=$a[codigo];
      $codb=$b[codigo];
      $coda=$this->borda[$coda][borda];
      $codb=$this->borda[$codb][borda];
      if ($coda == $codb) return 0;
      return ($coda > $codb) ? -1 : 1;
    }
    return $x;
  }

  function Vut($n)
  {
    // creamos recuento borda para desempates
    $b=new Borda();
    $b->opciones=$this->opciones;
    foreach ($this->votos as $p)
    {
      $i=0;
      while ($i < $p[num])
      {
        $b->papeletas[]=$p[papeleta];
        $i++;
      }
    }
    $this->borda=$b->GetEscrutinio();
    #print_R($this->borda);
    $log="\n-----------------------\nRecuento Vut para $n ganadores:\n";
    #$log.=print_r($this->borda,true);
    $ganadores=Array();
    $eliminados=Array();
    $candidatos=$this->Candidatos();
    $votos=$this->votos;
    $cuota=$this->CocienteDroop($n);
    $log.="Cuota: $cuota\n";
    if (count($candidatos)<$n) return false;
    while (count($ganadores) < $n)
    {
      #echo "\n*$n -- ".count($ganadores)." - " .count($eliminados);
      // Primero hago una suma de todo
      $recuento=Array();
      foreach ($candidatos as $c) if  (   (!in_array($c,$ganadores))  && (!in_array($c,$eliminados))   ) 
          $recuento[$c]=Array("codigo"=>$c,"votos"=>0);
      ##### eliminados no poner en reencuento
      $txtrecuento=Array();
      foreach ($votos as $k=>$v)
      {
        if (!(isset($v["frac"]))) { $v["frac"]=Array(1,1);  $votos[$k]=$v; }
        $ahora=false;
        // busco que opcion se usa en esta papeleta
        foreach ($v["papeleta"] as $op)
        {
          if (isset($recuento[$op]))
          {
            $ahora=$op;
            break;
          }
        }
        if (!($ahora===false))
        {
          $recuento[$ahora]=Array("codigo"=>$ahora,"votos"=>
          
          ( 
          $recuento[$ahora][votos] 
          +
            ($v["num"]  * $v["frac"][0] / $v["frac"][1])
          ) 
          );

          $txtrecuento[$ahora][]=$recuento[$ahora];
        }

      }

      // ordeno este primer recuento
      
      $existeganador=false;

      uasort($recuento,array($this, 'OrdenarRecuento'));
      $r2=Array();
      foreach ($recuento as $r)
      {
        $ii=$r[codigo];
        $jj=$r[votos];
        $r2[$ii]=$jj;
      }
      
      $recuento=$r2;
      
      $log.="\n".$this->logarray($recuento)."\n";

      #echo "eliminados".print_r($eliminados,true)."gandores".print_r($ganadores,true);
      foreach ($recuento as $op => $valor)
      {
        # echo "miro $op\n";
        if (($valor >= $cuota)  ||  ((count($ganadores)+count($recuento))<=$n))
        {
          $log.="ELEGIDO $op con $valor ($cuota)\n";
          $existeganador=true;
          /*
            necesito $cuota y tengo $valor
            de $valor queda en ($valor-$cuota)

            $valor  - ($valor-$cuota)
            1         x
          */
          $frac=Array();
          if ($cuota==$valor)
          {
            $frac[0]=0;
            $frac[1]=1;
          }
          else
          {
            $frac[0]=$valor-$cuota;
            $frac[1]=$valor;
          }
          if ($cuota>$valor) {$frac[0]=0;$frac[1]=1;}
          $log.="sus papeletas ahora valen ".round(100*$frac[0]/$frac[1],2)."%\n";
          foreach ($votos as $k=>$v)
          {
            foreach ($v["papeleta"] as $opp) 
            {
              if (   (!in_array($opp,$ganadores))  && (!in_array($opp,$eliminados))   )
              {
                if ($opp==$op)
                {
                  // estas papeletas hay que "adelgazarlas"
                  #$log.="adelgaza";
                  #$log.=print_r($votos[$k],true);
                  #$log.=print_r($votos[$k],true);
                  
                  $votos[$k]["frac"][0]=  bcmul($votos[$k]["frac"][0],$frac[0]);
                  #$log.="\n                  0 ".$votos[$k]["frac"][0]."-".$frac[0]."                  1 ".$votos[$k]["frac"][1]."-".$frac[1]."                  \n";
                  
                  $votos[$k]["frac"][1]=  bcmul($votos[$k]["frac"][1],$frac[1]);
                  #$log.="<BR>adelgazo $k<BR> ";
                  #$log.=print_r($votos[$k],true);
                  #$log.=print_r($votos[$k],true);
                }
                break;
              }
            }
          }
          // añado a op como ganador
          $ganadores[]=$op;
          // PONER UN BREAK AQUI Y RECALCULAR RECUENTO, O BUSCAR OTRO GANADOR NO SE SI AFECTA AL RESULTADO
          #break;
        }
      }
      // si no he añadido ningún ganador elimino al ultimo
      if (!($existeganador))
      {
        
        foreach ($recuento as $op => $valor) {$x=$op;}
        {
          $eliminados[]=$op;
          $log.="ELIMINO $op\n";
        }
      }
      



    }
    #echo "\nfin VUT\n";
    $perdedores=Array();
    foreach ($this->borda as $k=>$b)
    {
      if (!in_array($k,$ganadores)) $perdedores[]=$k;
    }

    $log.="\n\nResultado Final: \n\n";
    foreach ($ganadores as $g)
    {
      $log.="$g-".$this->opciones[$g]["titulo"]."\n";
    }
    $this->log="$log\n\n\n";
    $this->perdedores=$perdedores;
    $this->ganadores=$ganadores;
    return $ganadores;





  }
  
  function logarray($a)
  {
    $out="";
    foreach ($a as $k=>$v)
    {
      $txt=$this->opciones[$k]["titulo"];
      if (strlen($this->opciones[$k]["titulo"])>30) 
        $txt=$k." ".substr($txt,0,20);
      $out.="$txt\t$v\n";
    }
    return $out;
  }
  


}
