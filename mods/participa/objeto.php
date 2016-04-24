<?php



class Herramienta {

  function Herramienta($id)
  {
    global $HerramientasParticipacion;
    $this->tipos=$HerramientasParticipacion;
    $this->id=false;
    if (is_array($id))
    {
      // obligatorio tipo y titulo
      $mas=Array();
      $mas["id"]="NULL";
      $mas["tipo"]='"'.addslashes($id["tipo"]).'"';
      $mas["titulo"]='"'.addslashes($id["titulo"]).'"';
      $mas["txt"]='"'.addslashes($id["txt"]).'"';
      $mas["creacion"]="now()";
      $mas["creador"]=$id["creador"]->id;

      
      if (isset($id["modulo"])) $mas["modulo"]='"'.addslashes($id["modulo"]).'"';
      if (isset($id["elemento"])) $mas["elemento"]=(int)$id["elemento"];
      if (isset($id["proceso"])) $mas["proceso"]=(int)$id["proceso"];
      if (isset($id["verificado"])) $mas["verificado"]=(int)$id["verificado"];
      if (isset($id["inicio"])) $mas["inicio"]=(int)$id["inicio"];
      if (isset($id["fin"])) $mas["fin"]=(int)$id["fin"];
      if (isset($id["datos"])) $mas["datos"]=   '"'.addslashes(serialize($id["datos"])).'"';
      
      $campos=Array();
      $valor=Array();
      foreach ($mas as $k=>$v)
      {
        $this->$k=$v;
        $campos[]=$k;
        $valor[]=$v;
      }
      $sql="INSERT INTO herramientas(".implode(",",$campos).")
      VALUES (".implode(",",$valor).") ";
      mysql_query($sql);
      

      $this->id=mysql_insert_id();




    
    }
    else
    {
      $sql="select * from herramientas where id=".(int)$id;
      $res=mysql_query($sql);
      if ($row=mysql_fetch_array($res))
      {
        $this->id=$row[id];
        $this->creador=new Usuarios(false,$row["creador"]);
        $this->titulo=$row[titulo];
        $this->txt=$row[txt];
        $this->tipo=$row[tipo];
        $this->modulo=$row[modulo];
        $this->elemento=$row[elemento];
        $this->proceso=$row[proceso];
        $this->verificado=$row[verificado];
        $this->creacion=$row[creacion];
        $this->inicio=$row[inicio];
        $this->fin=$row[fin];
        $this->datos=unserialize($row[datos]);
        
        $this->url="/".$HerramientasParticipacion[$this->tipo]["modulo"]."/".$this->id."/";
        $this->activa=false;

        if ($this->inicio) 
        {
          if ($this->inicio<date("Y-m-d H:i:s"))
          {
            if ($this->fin)
            {
              $this->activa=($this->fin>date("Y-m-d H:i:s"));
            }
            else
              $this->activa=true;
          }
        }


        
      }
      
    }
  }
  
  function GuardarDatos()
  {
    mysql_query("update herramientas set datos =     \"".addslashes(serialize($this->datos))."\" where id = ".$this->id);
  }
  
  function Visible($usuario)
  {
    if ($usuario->id==$this->creador->id) return true;
    if ($this->modulo)
    {
      $per=GetPermiso($usuario,$this->moduo,$this->elemento);
      if ($per==0) return false;
    }
    if ($this->verificado)
    {
      if ($usuario->verificado!=1) return false;
    }
    if ($this->comision)
    {
      $per=GetPermiso($usuario,"comision",$this->comision);
      if ($per==0) return false;
    }
    return true;
  }
}

class BuscadorHerramientas 
{
  var $finalizadas=false;
  var $usuario=false;

  function Buscar()
  {
    $this->res=Array();
    $mw="";
    if (!($this->finalizada)) $mw = " and (fin > now() or fin is null) ";
    $sql="SELECT id FROM herramientas 
    where 1 $mw
    order by inicio desc ";
    $res=mysql_query($sql);

    while ($row=mysql_fetch_array($res)) 
    {
      $id=$row["id"];
      $h=new Herramienta($id);
      if ($this->usuario)
      {
        if ($h->visible($this->usuario))
           $this->res[$id]=$h;
      }
    }
  }
}


/*

una herramienta es visible por un usuario en función de los permisos en modulo/elemento o de la comisión, los valores pueden ser NULL


CREATE TABLE `herramientas` (
  id int(11) NOT NULL AUTO_INCREMENT,

  creador int(11) NOT NULL DEFAULT '0',   
  
  tipo char(50) NOT NULL DEFAULT '',
  titulo varchar(250) DEFAULT NULL,
  txt text,



  modulo char(50) NOT NULL DEFAULT '',
  elemento int(11) NOT NULL DEFAULT '0',
  proceso int(11) unsigned DEFAULT '0',
  comision int(11) unsigned DEFAULT '0',

  verificado tinyint(1) DEFAULT NULL,
  creacion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  inicio timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  fin timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  datos text,
  PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/ 