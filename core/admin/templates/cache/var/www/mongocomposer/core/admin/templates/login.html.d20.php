<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html>
<head>
	<title>Mongo Admin</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/admin_assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/admin_assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/admin_assets/css/font-awesome.min.css">
	<script type="text/javascript" src="/admin_assets/js/jquery.js"></script>
	<script type="text/javascript" src="/admin_assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/admin_assets/bootstrap/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<style type="text/css">
	
	</style>
</head>
<body>
	<div class="conten_login">
		<img src="/admin_assets/img/logo_mongo.png" />
		
		
		<?php if ((isset($this->scope["error"]) ? $this->scope["error"] : null)) {
?>

		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Rayos y Centellas!</strong> <?php echo $this->scope["error"];?>

		</div>
		<?php 
}?>

		<form method="post">
			<input class="span4" type="text" name="user" placeholder="usuario"><br>
			<input class="span4" type="password" name="pass" placeholder="contraseña"><br>
			<input type="submit" class="btn btn-login" name="login" value="Entrar">
		</form>
	</div>
	<div class="footer_login">
		<div class="logo_elmundo_login"></div>
		<p>Mongo framework es un software libre, ocúpelo si puede © 2014</p>
		
	</div>
</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>