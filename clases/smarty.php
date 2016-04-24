<?php

require($home."/clases/smarty-2.6.28/libs/Smarty.class.php");

importclass("permisos");

class Plantilla extends Smarty {

   function Plantilla()
   {
     global $usuario,$baseurl,$ciudad,$titulopagina,$urlreferencia,$siteadmin,$permisos,$organizacion;

        // Class Constructor. 
        // These automatically get set with each new instance.

	global $home;

        $this->Smarty();

        $this->template_dir = $home.'/plantillas/';
        $this->compile_dir  = $home.'/smarty/templates_c/';
        $this->config_dir   = $home.'/smarty/configs/';
        $this->cache_dir    = $home.'/smarty/cache/';
        $this->caching = false;
        $usu[id]=$usuario->id;
        $usu[nick]=$usuario->nick;
        $usu[email]=$usuario->email;
        $this->assign("usuario",$usu);
        $this->assign("baseurl",$baseurl);
        $this->assign("ciudad",$ciudad);
        $this->assign("titulopagina",$titulopagina);
        $this->assign("urlreferencia",$urlreferencia);
        $this->assign("siteadmin",$siteadmin);
        $this->assign("permisos",$permisos);
        $this->assign("organizacion",$organizacion);

   }
   
}


