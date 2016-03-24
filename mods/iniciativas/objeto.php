<?php
/*



drop table propuesta;
CREATE TABLE propuesta (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  autor int(11) UNSIGNED NOT NULL,
  titular varchar(250),
  texto text,
  categoria smallINT(5) UNSIGNED default 0,
  votosok int(11) UNSIGNED default 0,
  votosko int(11) UNSIGNED default 0,
  valor INT(11) UNSIGNED default 0,
  primary key (id)
) ENGINE=InnoDB CHARSET=utf8;

drop table propuesta_voto;

create table propuesta_voto (
  usuario int(11) UNSIGNED,
  propuesta int(11) UNSIGNED,
  voto tinyint(3) UNSIGNED default 0,
  primary key (usuario,propuesta)
);



drop table  categorias;
create table categorias (
  id smallINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  ncorto char(50),
  titulo varchar(250),
  descripcion text,
  orden SMALLINT(5) UNSIGNED default 100,
  nivel TINYINT(3) UNSIGNED default 0,
  borrado tinyint(3) UNSIGNED default 0,
  primary key (id)
);



insert into categorias values ("NULL","xx","Iniciativa institucional","Iniciativas que tienen la finalidad de ser ejecutadas a través del grupo municipal del Ayuntamiento. Ya sea a través del pleno (reglamentos, mociones, etc.) o para presentarlo al gobierno municipal a través de los concejales de Ganemos Jerez. 
",100,0,0);
insert into categorias values ("NULL","xx","Proyecto","Son iniciativas ciudadanas impulsadas por Ganemos o de manera conjunta con otras fuerzas políticas y sociales, o en las que Ganemos participa y que no tienen directamente que ver con la actividad en el Ayuntamiento
",100,0,0);
insert into categorias values ("NULL","xx","Petición de comparecencia","Cualquier vecino/organización puede solicitar que algún concejal de Ganemos Jerez 
",100,0,0);
insert into categorias values ("NULL","xx","Propuesta interna de Ganemos Jerez","Propuestas que afectan al funcionamiento de Ganemos jerez, cambios en la organización interna de Ganemos Jerez, creación de comisiones, métodos de toma de decisiones, pronunciamientos públicos de Ganemos Jerez, firma/apoyo de llamamientos y convocatorias,
",100,0,0);
insert into categorias values ("NULL","xx","Organización interna","Propuestas solo visibles y votables por miembros activos de Ganemos Jerez
",100,0,0);










* Iniciativa institucional

Iniciativas que tienen la finalidad de ser ejecutadas a través del grupo municipal del Ayuntamiento. Ya sea a través del pleno
(reglamentos, mociones, etc.) o para presentarlo al gobierno municipal a través de los concejales de Ganemos Jerez.

* Proyecto

Son iniciativas ciudadanas impulsadas por Ganemos o de manera conjunta con otras fuerzas políticas y sociales, o en las que
Ganemos participa y que no tienen directamente que ver con la actividad en el Ayuntamiento

* Petición de comparecencia

Cualquier vecino/organización puede solicitar que algún concejal de Ganemos Jerez 

* Propuesta "interna" de Ganemos Jerez

Propuestas que afectan al funcionamiento de Ganemos jerez, cambios en la organización interna de Ganemos Jerez, creación de
comisiones, métodos de toma de decisiones, pronunciamientos públicos de Ganemos Jerez, firma/apoyo de llamamientos y convocatorias,

* Organización interna

Propuestas solo visibles y votables por miembros activos de Ganemos Jerez





*/


class Propuesta
{
   var $id=0;

   function Propuesta($id)
   {
     if (is_array($id))
     {
       // introduce propuesta con usuarioid, titular, texto y categoriaid
       $sql="insert into propuesta(id,autor,titular,texto,categoria,fecha)
         values (NULL,$id[usuarioid],
           \"".addslashes($id[titular])."\",
           \"".addslashes($id[texto])."\", $id[categoria] , now() ) ";
       mysql_query($sql);
       $id=mysql_insert_id();
       if ($id>0)
       {
         $u=new Usuarios(false,$id);
         $this->id=$id;
         $this->votar($u,1);
       }

       
     }

     $sql="
     select p.id,p.autor,p.titular,p.texto,p.categoria as idcat , c.titulo as categoria, unix_timestamp(fecha) as fecha 
     from propuesta  p , categorias c 
     where
     p.categoria=c.id
     and
     p.id=".(int)$id;
     $res=mysql_query($sql);
     if ($row=mysql_fetch_array($res))
     {
       $this->id=$row[id];
       $this->titular=$row[titular];
       $this->texto=$row[texto];
       $this->categoria=$row[categoria];
       $this->idcat=$row[idcat];
       if (strlen($this->texto)>300) $this->textomini=substr(html2text($this->texto),0,250);
       $this->categoria=$row[categoria];
       $this->idcat=$row[idcat];
       $this->fecha=$row[fecha];
       $this->fechatxt=fechaTOhace($row[fecha]);
       $this->recuento();
       $this->puntos=(int)((60*60*24*30*12)*($this->up - $this->down)/(time()-$row[fecha])); // votos por semana
       $this->valor=($this->up - $this->down);
       $this->autor=new Usuarios(false,$row[autor]);
       $sql="select count(*) as n from propuesta_colaborador where propuesta=".$this->id;
       $res=mysql_query($sql);
       $row=mysql_fetch_array($res);
       $this->numcolaboradores=$row["n"];

       
       
     }
   }

   function Votar($usuario,$voto)
   {
     if ($voto==2)
     {
       mysql_query("delete from propuesta_voto where usuario=".$usuario->id." and propuesta=".$this->id);
     }
     else
     {
       if ($voto==1) $v=1; else $v=0;
       
       mysql_query("insert into propuesta_voto(usuario,propuesta,voto) values (".$usuario->id.",".$this->id.",$v)
         on duplicate key update voto=$v 
       ");
     }
     echo mysql_error();
     $this->recuento();

             
   }
   
   function recuento()
   {
     $this->down=0;
     $this->up=0;
     $res=mysql_query("select voto,count(*) as n from propuesta_voto where propuesta=".$this->id." group by voto");
     while ($row=mysql_fetch_array($res))
     {
       if ($row[voto]==0)
         $this->down=$row[n];
       else
         $this->up=$row[n];
     }
   }

   function IsColaborador($usuario)
   {
     $sql="select count(*) as n from propuesta_colaborador where usuario=".$usuario->id." and propuesta=".$this->id;
     $res=mysql_query($sql);
     $row=mysql_fetch_array($res);
     return ($row["n"]>0);
   }

   function SetColaborador($usuario,$c=true)
   {
   
     if ($c)
       $sql="insert into propuesta_colaborador (usuario,propuesta) values (".$usuario->id.",".$this->id.")";
     else
       $sql="delete from propuesta_colaborador where usuario=".$usuario->id." and propuesta=".$this->id;
     $res=mysql_query($sql);
     return $this->IsColaborador($usuario);
   }
   
}


class ControladorPropuestas
{

   var $orden="prioridad";
   var $usuario=false;

   function GetCategorias($esmiembro=false)
   {
     $out=Array();
     if (!($esmiembro)) $w=" and nivel=0 ";
     $sql="select id,titulo,nivel,descripcion from categorias where borrado=0 $w order by orden,titulo ";
     $res=mysql_query($sql);
     while ($row=mysql_fetch_array($res))
     {
       $id=$row[id];
       $out[$id]=$row;
     }
     return $out;
   }

   function ordenar($a,$b)
   {
     if ($this->orden=="fecha") $val="fecha";
     if ($this->orden=="valor") $val="valor";
     if (!(isset($val))) $val="puntos";
     if ($a->$val == $b->$val) {
        return 0;
     }
     return ($a->$val < $b->$val) ? +1 : -1;
  
   }
   
   function GetPropuestas()
   {
     $sql="select id from propuesta where 1 ";
     if ($this->categoria) $sql.=" and categoria=".$this->categoria;
     
     $sql.=" order by id desc ";
     $res=mysql_query($sql);
     $out=Array();
     while ($row=mysql_fetch_array($res))
     {
        $p=new Propuesta($row[id]);
        
        if ($this->usuario)
        {
          $sql="select voto from propuesta_voto where propuesta=".$p->id." and usuario=".$this->usuario->id;
          #echo "$sql<p>";
          $ress=mysql_query($sql);
          if ($row=mysql_fetch_array($ress))
          {
            if ($row[voto]==0) $row[voto]=3;
            $p->votousuario=$row[voto];
          }
        }
        #else         echo "*";
        $out[]=$p;
     }

     usort($out,array("ControladorPropuestas","ordenar"));
     return $out;   
   }
   
}
