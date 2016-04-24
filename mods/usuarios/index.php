<?php




if (isset($_GET[op])) $op=$_GET[op];

if ($op=="salir")
{
  $usuario->salir();exit;
}

if ($op=="entrar")
{
  $usuario=new usuarios;
  
  $usuario->entrar(stripslashes($_POST[email]),stripslashes($_POST[pwd]));

  mostrartpl("cabecera.bs.tpl");
  if ($usuario->id)
    echo  $usuario->id." Autentificación correcta ";
  else
    echo "Email y/o contraseña invalido/s";
  mostrartpl("pie.bs.tpl");
  exit;

}


if ($op!="alta3") mostrartpl("cabecera.bs.tpl");

  $html->assign("verificado",$usuario->verificado);
  $html->assign("dataverificacion",$usuario->dataverificacion);
    


if ($op == "alta")
{
  $u=new Usuarios();
  if ($u->peticion($_POST[email]))
    $html->assign("msg", "<h3>Revise su email para continuar el proceso de alta</h3>");
  else
    $html->assign("msg", "<h3>Error: Ya está registrado o ya ha hecho una petición de registro las últimas 24 horas (compruebe su correo)</h3>");
  unset($op);  
}

if (!(isset($op)))
{

  // colaborador
  if ($usuario->id>0)
  {
    $html->assign("ciudad",$ciudad);
    $html->assign("intereses",$intereses);
    $html->assign("distritos",$distritos);
    $html->assign("txtdistritos",$txtdistritos);
    $html->assign("externos",$externos);
    
    if ($_GET[go]=="colaborador")
        if (isset($_POST[nombre]))
           $usuario->AltaColaborador($_POST);

    if ($usuario->GetColaborador())
    {
      if ($_GET[go]=="colaborador")
      {
        
        $cambio=Array();
        if (!(isset($_POST[nombre])))
        {
          if (isset($_POST[mailing])) $ma=1; else $ma=0;
          if ($ma<>$usuario->colaborador[mailing]) $cambio[]="mailing=$ma";
          if (isset($_POST[moviling])) $mo=1; else $mo=0;
          if ($mo<>$usuario->colaborador[moviling]) $cambio[]="moviling=$mo";
        }


        if (count($cambio)>0)
          mysql_query("update colaboradores set ".implode(",",$cambio)." where id=".$usuario->id );
        echo mysql_error();
        
        mysql_query("delete from intereses where usuario=".$usuario->id);
        foreach ($intereses as $in)
        {
          foreach ($in as $k=>$v)
          {
            if (isset($_POST[$k])) mysql_query("insert into intereses(usuario,interes) values(".$usuario->id.",'$k')");
          }
        }
        
        
        $usuario->GetColaborador();
      }
      $html->assign("interesesusuario",$usuario->intereses);
      $html->assign("colaborador",$usuario->colaborador);
    }
  }

  $html->display("inicio.tpl");
}


if ($op=="alta3")
{
  $n=$_POST[u];
  $pa=$_POST[pa];
  $pb=$_POST[pb];
  unset($msg);
  if (strlen($n)>250)
    $msg="El nombre es demasiado largo";
  if (strlen($n)<3)
    $msg="El nombre es demasiado corto";
  if ((strlen($pa)<3) || (strlen($pa)>10))
    $msg="La contraseña debe contener entre 3 y 10 carácteres";
  if ($pa!=$pb)
    $msg="Las contraseñas no son iguales";

  if (isset($msg))
  {
    $html->assign("msg",$msg);
    $op="alta2";
    $_GET[pwd]=$_POST[pwd];
    mostrartpl("cabecera.bs.tpl");
  }
  else
  {
    $u=new Usuarios();
    $u->confirmar($_POST[pwd],$n,$pa);  
    $html->assign("msg","Ya estás registrado@");
    mostrartpl("cabecera.bs.tpl");
    echo "Ya estás registrad@ ;) <br><a class=button href='/?mod=usuarios'>Acceder</a>";
  }
  
}



if ($op=="alta2")
{
  $u=new Usuarios();
  if ($email=$u->preconfirmar($_GET[pwd]))
  {
    if (isset($msg)) $html->assign("msg",$msg);
    $html->assign("email",$email);
    $html->assign("nick",$_POST[u]);
    if ($pa==$pb) $html->assign("pab",$pa);
    $html->assign("pwd",$_GET[pwd]);

    $html->display("registro.tpl");

  }
  else
    echo "Validacion incorrecta";
}

if ($op=="recordar")
{
  if ($subop=="go")
  {
    $x=explode("-",$_GET[md]);
    if (count($x)==2)
    {
      $u=new Usuarios(false,(int)$x[0]);
      if ($u->md($x[1]))
      {
        $html->assign("md",$_GET[md]);
        if ($_POST[pwda])
        {
          unset($msg);
          if ((strlen($_POST[pwda])<3) || (strlen($_POST[pwda])>10))
            $msg="La contraseña debe contener entre 3 y 10 carácteres";
          if ($_POST[pwda]!=$_POST[pwdb])
            $msg="Las contraseñas no iguales";
          if ($msg)
          {
             $html->assign("msg",$msg);
             $html->display("reset.password.tpl");
          }
          else
          {
            $u->setpwd($_POST[pwda]);
            $html->assign("msg","Contraseña reseteada");
            $html->display("inicio.tpl");
          }
        
        }
        else
        {
          $html->display("reset.password.tpl");
        }
      }
      else
        echo "Petición expirada, vuelva a intentarlo.";
    }
  }  
  if (!($subop))
  {

    $u=GetUsuarioByEmail($_POST[email]);
    if ($u)
    {
      $u->recordar();
      $html->assign("msg","Compruebe su correo electrónico");
    }
    else  
      $html->assign("msg","No está registrado");
    $html->display("inicio.tpl");
  }
  
}

mostrartpl("pie.bs.tpl");

