<?php

importclass("participa");
require("vut.php");
require("borda.php");

class Votacion extends Herramienta
{
    function Votacion($id)
    {
      parent::Herramienta($id);
      foreach ($this->datos["preguntas"] as $k=>$p)
      {
        if ($p["escrutinio"]=="vut")
        {
           if ($k==3)
           {
             #$this->datos["preguntas"][$k]["numvut"]=7;
             #$this->GuardarDatos();
           }
        }
      }
    }
    
    function addPregunta($data)
    {
      if (!(is_array($this->datos))) $this->datos=Array();
      if (!(isset($this->datos["preguntas"]))) $this->datos["preguntas"]=Array();
      $this->datos["preguntas"][]=$data;
      $this->GuardarDatos();
    }
    
    function GetVoto($usuario)
    {
      $sql="select voto from votos_tmp where votacion=".$this->id." and usuario=".$usuario->id;
      $res=mysql_query($sql);
      if ($row=mysql_fetch_array($res))
      {
        return unserialize($row["voto"]);
      }
      else
      {
        $out=Array();
        foreach ($this->datos["preguntas"] as $k=>$v)
        {
          $out[$k]=Array();
        }
        return $out;
      }
    }
    function PutVoto($usuario,$voto)
    {
      $sql="INSERT INTO votos_tmp (votacion,usuario,voto) 
      values (".$this->id.",".$usuario->id.",\"".addslashes(serialize($voto))."\" )
      ON DUPLICATE KEY UPDATE voto=\"".addslashes(serialize($voto))."\" ";
      mysql_query($sql);
    }
    
    function UsuarioHaVotado($usuario)
    {
      $sql="select * from votante where usuario=".$usuario->id." and votacion=".$this->id;
      $res=mysql_query($sql);
      return mysql_fetch_array($res);
    }
    
    function Votar($usuario,$mesa=0)
    {
      $v=$this->GetVoto($usuario);
      if (!($this->UsuarioHaVotado($usuario)))
      {
        golog("vota ".$this->id);
        $sql="insert into votante (votacion,usuario,mesa,fecha)
              values(".$this->id.",".$usuario->id.",$mesa,now() ) ";
        mysql_query($sql);
        echo mysql_error();
        $codigo="";
        while (strlen($codigo)<30) $codigo.=dechex(rand(0,15));
        
        $sql="insert into votos (codigo,votacion,mesa,voto)
        values ('$codigo',".$this->id.",$mesa,\"".addslashes(serialize($v))."\")
        ";
        mysql_query($sql);
        return $codigo;
      }
    }
    
    function Participacion()
    {
      $acu=0;
      $mesas=Array();
      $sql="select mesa,count(*) as n from votos where votacion=".$this->id." group by mesa order by mesa ";
      $res=mysql_query($sql);
      while ($row=mysql_fetch_array($res))
      {
        $mesa=$row["mesa"];
        $mesas[$mesa]=$row["n"];
        $acu=$acu + $row["n"];
      }
      return Array("mesas"=>$mesas,"total"=>$acu);
    }
    
    function GetPapeletas($mesa=false)
    {
      $sql="select voto from votos where votacion=".$this->id;
      if (!($mesa===false)) $sql.=" and mesa=$mesa ";
      $res=mysql_query($sql);
      $out=Array();
      while ($row=mysql_fetch_array($res))
      {
        $out[]=unserialize($row["voto"]);
      }
      return $out;

      
    }
    
    function Escrutinio($pregunta=false,$mesa=false,$papeletas=false)
    {
      if (!$papeletas)
      {
        $p=$this->GetPapeletas($mesa);
        $papeletas=Array();
        foreach ($p as $pp)
        {
          foreach ($pp as $prg => $res)
            $papeletas[$prg][]=$res;
        }
      }
      if ($pregunta===false)
      {
        $res=Array();
        foreach ($this->datos["preguntas"] as $k=>$p)
        {
          $res[$k]=$this->Escrutinio($k,$mesa,$papeletas[$k]);
        }
        return $res;
      }
      else
      {
        $res=Array();
        $res["votos"]=count($papeletas);
        $res["blancos"]=0;
        foreach ($papeletas as $p) if ( count($p) == 0) $res["blancos"]++;
        if ($this->datos["preguntas"][$pregunta]["escrutinio"]=="vut")
        {
          #print_r($this->datos["preguntas"][$pregunta]);
          if ($this->datos["preguntas"][$pregunta]["tipovut"]=="ranking")
          {}
          else
          {
            $res["resultado"]=$this->VutNum($papeletas,$pregunta,$this->datos["preguntas"][$pregunta]["numvut"]);
            $res["borda"]=$this->borda;



            #$res["resultado"]=$this->Vut($papeletas,$pregunta);
            $res["perdedores"]=$this->perdedores;
            $res["vutlog"]=$this->vutlog;
            $res["borda"]=$this->borda;
            #print_r($this->borda);
          }
        }
        return $res;
      }
    }
    function VutNum($papeletas,$pregunta,$numvut)
    {
      $vut=new VotoVut();
      $vut->opciones=$this->datos["preguntas"][$pregunta]["opciones"];
      foreach ($papeletas as $p)
      {
        $vut->NuevaPapeleta($p);
      }
      $ganan=$vut->Vut($numvut);
      $this->borda=$vut->borda;
      $this->perdedores=$vut->perdedores;
      $log=Array($vut->log);
      $i=1;
      $list=Array();
      while (count($list)<$numvut)
      {
        $x=$vut->Vut($i);
        $log[]=$vut->log;
        foreach ($x as $y)
          if ( (in_array($y,$ganan)) &&  (!in_array($y,$list)))
            $list[]=$y;
        $i++;
      }
      $this->vutlog=$log;
      return $list;
    }
    
    function Vut($papeletas,$pregunta)
    {
      $vut=new VotoVut();
      $vut->opciones=$this->datos["preguntas"][$pregunta]["opciones"];
      foreach ($papeletas as $p)
      {
        $vut->NuevaPapeleta($p);
      }
      $res=$vut->Vut(3);
      $this->log=$vut->log;
      $this->perdedores=$vut->perdedores;
      return $res;
    }
    
}                        

