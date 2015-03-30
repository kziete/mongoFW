<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;

$_fh0_data = (isset($this->scope["opciones"]) ? $this->scope["opciones"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

	<label class="checkbox">
		<input type="checkbox" name="<?php echo $this->scope["name"];?>[]" value="<?php echo $this->scope["item"]["id"];?>" <?php if ((isset($this->scope["item"]["checked"]) ? $this->scope["item"]["checked"]:null)) {
?>checked=""<?php 
}?>>
		<?php echo $this->scope["item"]["label"];?>

	</label>
<?php 
/* -- foreach end output */
	}
}?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>