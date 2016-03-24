<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--meta name="description" content="{$titulopagina}">
    <meta name="author" content=""-->
    <link rel="icon" href="/favicon.ico">

    <title>{$titulopagina}</title>



    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/estilos.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/bootbox.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->






{foreach from=$css item=j}
<link href="{$j}" rel="stylesheet" type="text/css" />
{/foreach}


{foreach from=$js item=j}
<script type='text/javascript' src='{$j}'></script>
{/foreach}




  </head>

  <body style='background-image: url("img/fondo.jpg");' >


<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-main" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">{$titulopagina}</a>
        </div>
        <center>
            <div id="navbar-main" class="navbar-collapse collapse" style="height: 1px;">
                <ul class="nav navbar-nav">

                    {*<li class=active><a class=href="/">{$titulopagina}</a></li>*}
                    {*<li><a href="/{$mod}/">{$mod}</a></li>*}
                    <li><a href="/iniciativas/">Iniciativas</a></li>

{foreach from=$menusadmin item=i}

                    <li><a href="{$i.url}">{$i.name}</a></li>


{/foreach}


                    {*<li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a>
                            </li>
                        </ul>
                    </li>*}

                </ul>

                {if $usuario.id==0}


{*
          <form action="/{if $mod!="usuarios"}{$mod}{/if}/{$op}/{$subop}/" class="navbar-form navbar-right" method=post>
            <div class="form-group">
              <input name=introemail type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name=intropwd placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
*}







                <form action="/{if $mod!="usuarios"}{$mod}{/if}/{$op}/{$subop}/" role="search" class="navbar-form navbar-right" method=post>
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="introemail" class="form-control" value="{$introemail}">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="intropwd" class="form-control">
                    </div>
                    <button class="btn btn-default" type="submit">Entrar</button>
                </form>
               {else}

        <div class="navbar-right">
           <a class="navbar-brand" href="/usuarios/">{$usuario.nick}</a>
           <a class="navbar-brand" href="/usuarios/salir/">Salir</a>
        </div>



                {/if}
            </div>
        </center>
    </div>
</div>


{*

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">{$titulopagina}</a>
          <a class="navbar-brand" href="/{$mod}/">{$mod}</a>
        </div>
        {if $usuario.id==0}
        <div id="navbar" class="navbar-collapse collapse">

           <a class="navbar-brand" href="/usuarios/">Registrarse</a>

          <form action="/{$mod}/{$op}/{$subop}/" class="navbar-form navbar-right" method=post>
            <div class="form-group">
              <input name=introemail type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name=intropwd placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
        {else}
        <div class="navbar-right">
           <a class="navbar-brand" href="/usuarios/">{$usuario.nick}</a>
           <a class="navbar-brand" href="/usuarios/salir/">Salir</a>
        </div>
        {/if}



      </div>
    </nav>


*}

<div style="margin-top: 50px;">
