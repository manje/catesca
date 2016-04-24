<?php

class Borda 
{
  var $papeletas=Array();
  
  function Borda()
  {
  }
  
  function getEscrutinio()
  {
     $cols=0;
     foreach ($this->papeletas as $x)
     {
       if (count($x)>$cols) $cols=count($x);
     }
     $tabla=Array();
     $totalesopc=Array();
     $totalescol=Array();
     $i=1;
     while ($i <= $cols)
     {
       $totalscol[$i]=0;
       $i++;
     }
     $codigos=Array();

     foreach ($this->opciones as $op=>$opp)
     {
       $i=1;
       $c=$op;
       $codigos[]=$c;
       $totalesopc[$c]=0;
       $tabla[$c][perfil]=$opp;
       while ($i <= $cols)
       {
         $tabla[$c][tabla][$i][num]=0;
         $tabla[$c][borda]=0;
         $i++;
       }
     }
     $num=count($this->papeletas);
     foreach ($this->papeletas as $papeleta)
     {
       foreach ($papeleta as $k=>$p)
       {
         $i=$k+1;
         $tabla[$p][tabla][$i][num]++;
         $totalesopc[$p]++;
         $totalescol[$i]++;
       }
     }
     // calculo borda
     foreach ($codigos as $cod)
     {
       $tot=0;
       $i=1;
       while ($i <= $cols)
       {
         $tabla[$cod]["borda"]=$tabla[$cod]["borda"]+$tabla[$cod][tabla][$i][num]/$i;
         $tot=$tot+$tabla[$cod][tabla][$i][num];
         #$tabla[$cod][tabla][$i][tpca]=round(100*$tabla[$cod][tabla][$i][num]/$totalescol[$i],2) ;
         $tabla[$cod][tabla][$i][tpca]=round(100*$tabla[$cod][tabla][$i][num]/$num,2);
         $tabla[$cod][tabla][$i][tpcb]=round(100*$tot/$num,2);
         $i++;
       }
       $tabla[$cod]["borda"]["total"]=$tot;
     }
     uasort($tabla,"cmp");
     $this->totalesopc=$totalesopc;
     $this->totalescol=$totalescol;
     return $tabla;

                
  }
  
}

function cmp($a,$b)
{
  if ($a[borda] == $b[borda]) {
    return 0;
  }
  return ($a[borda] > $b[borda]) ? -1 : 1;
}

