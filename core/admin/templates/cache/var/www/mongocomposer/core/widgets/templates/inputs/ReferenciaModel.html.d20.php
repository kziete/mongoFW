<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><select name="<?php echo $this->scope["name"];?>">
	<option value="">Seleccione</option>
	<?php 
$_fh0_data = (isset($this->scope["opciones"]) ? $this->scope["opciones"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

		<option value="<?php echo $this->scope["item"]["id"];?>" <?php if ((isset($this->scope["item"]["selected"]) ? $this->scope["item"]["selected"]:null)) {
?>selected=""<?php 
}?>><?php echo $this->scope["item"]["label"];?></option>
	<?php 
/* -- foreach end output */
	}
}?>

</select><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>