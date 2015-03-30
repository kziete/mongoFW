<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><h2>Contenido número 1</h2>
<div class="formulario_int">
	<?php 
$_fh0_data = (isset($this->scope["includes"]) ? $this->scope["includes"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

		<?php echo $this->scope["item"];?>

	<?php 
/* -- foreach end output */
	}
}?>

	<form method="post" enctype="multipart/form-data" class="form-horizontal">
		<?php if ((isset($this->scope["error"]) ? $this->scope["error"] : null)) {
?>

		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> Por favor, corrija los siguientes errores.
		</div>
		<?php 
}?>

		<?php 
$_fh1_data = (isset($this->scope["campos"]) ? $this->scope["campos"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

		<div class="control-group <?php if ((isset($this->scope["item"]["error"]) ? $this->scope["item"]["error"]:null)) {
?>error<?php 
}?>">
			<label class="control-label"><?php echo $this->scope["item"]["nombre"];?></label>
			<div class="controls">
				<?php echo $this->scope["item"]["input"];?>

				<?php if ((isset($this->scope["item"]["error"]) ? $this->scope["item"]["error"]:null)) {
?>

					<span class="help-inline"><?php echo $this->scope["item"]["error"];?></span>
				<?php 
}?>

			</div>
		</div>
		<?php 
/* -- foreach end output */
	}
}?>

		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<a href="/admin/<?php echo $this->scope["modelo"];?>" class="btn btn-warning">Cancelar</a>
				<button type="submit" name="aceptar" value="1" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</form>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>