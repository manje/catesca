<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="es"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="es"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="es"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="es"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>-{$mod}-{$titulopagina}</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
{foreach from=$css item=j}
<link href="{$j}" rel="stylesheet" type="text/css" />
{/foreach}

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">



{foreach from=$js item=j}
<script type='text/javascript' src='{$j}'></script>
{/foreach}
<script type='text/javascript' src='/estilos.css'></script>

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->



	<div class="container">
		<div class="sixteen columns cabecera" onclick="javascript:document.location.href='/'">
			<h1 class="remove-bottom" >{$titulopagina}</h1>
			<h5>Sistema de votación para primarias</h5>

		</div>




 <div class="sixteen columns clearfix">

<!-- In nested columns give the first column a class of alpha

and the second a class of omega -->

<div class="twelve columns alpha">



