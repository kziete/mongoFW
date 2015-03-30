<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
// checking for modification in file:/var/www/mongocomposer/core/admin/templates/contenedor_.html
if (!("1427741179" == filemtime('/var/www/mongocomposer/core/admin/templates/contenedor_.html'))) { ob_end_clean(); return false; };?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mongo :B</title>
    <link rel="stylesheet" type="text/css" href="/admin_assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/admin_assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/admin_assets/css/font-awesome.min.css">
    <script type="text/javascript" src="/admin_assets/js/jquery.js"></script>
    <script type="text/javascript" src="/admin_assets/bootstrap/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<div class="wraper">
	    <div class="navbar">
	      <div class="navbar-inner">
	        <a class="brand" href="#">Mongo</a>
	        <h3 class="cliente">Sitio</h3>
	        <!-- Listado de futuras funcionalidades <ul class="nav">
	          <li class="active"><a href="#">Home</a></li>
	          <li><a href="#">Link</a></li>
	          <li><a href="#">Link</a></li>
	        </ul>-->
	        
	        <ul class="nav pull-right">
	          <li class="usuario"><span>Bienvenido</span> administrador</li>
	          <li class="logout"><a href="?logout=1"><i class="fa fa-times"></i></a></li>
	        </ul>
	      </div>
	    </div>
	    <div class="contenedor_principal">
	      <div class="row-fluid">
	        <div class="span12">
	          <ul class="breadcrumb">
	<li class="pri">Te encuentras en: </li>
	<li class="active">Admin</li>
</ul>

<div class="row-fluid">
	<div class="span9">
		<?php 
$_fh1_data = (isset($this->scope["disponibles"]) ? $this->scope["disponibles"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['dispo'])
	{
/* -- foreach start output */
?>

		<ul class="nav nav-list lista_categoria">
			
			<li class="nav-header"><?php echo $this->scope["dispo"]["categoria"];?></li>		
			<?php 
$_fh0_data = (isset($this->scope["dispo"]["lista"]) ? $this->scope["dispo"]["lista"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

			<li><a href="/admin/<?php echo $this->scope["item"]["adminName"];?>"><?php echo $this->scope["item"]["nombre"];?></a>
				<?php if (! (isset($this->scope["item"]["bloqueado"]) ? $this->scope["item"]["bloqueado"]:null)) {
?>

					<a href="/admin/<?php echo $this->scope["item"]["adminName"];?>/-1" class="edit_mas"><i class="fa fa-plus"></i></a>
				<?php 
}?>

			</li>
			<?php 
/* -- foreach end output */
	}
}?>


		</ul>
		<?php 
/* -- foreach end output */
	}
}?>

	</div>
	 <div class="span3 visor_right"></div>
	
</div>
	        </div>
	       
	      </div>
	    </div> 
	    <div class="push"></div>
	</div>  
    <div class="footer">
	    <p>Mongo framework es un software libre, ocúpelo si puede © 2014</p>
	    <div class="footer_logo"></div>
    </div>
    <script type="text/javascript" src="/admin_assets/js/responsive.js"></script>
  </body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>