<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
if (! (isset($this->scope["usarSelect"]) ? $this->scope["usarSelect"] : null)) {
?>

	<?php 
$_fh0_data = (isset($this->scope["opciones"]) ? $this->scope["opciones"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

	<label class="radio">
		<input type="radio" name="<?php echo $this->scope["name"];?>" value="<?php echo $this->scope["item"]["value"];?>" <?php if ((isset($this->scope["item"]["checked"]) ? $this->scope["item"]["checked"]:null)) {
?>checked=""<?php 
}?>>
		<?php echo $this->scope["item"]["label"];?>

	</label>
	<?php 
/* -- foreach end output */
	}
}?>

<?php 
}?>


<?php if ((isset($this->scope["usarSelect"]) ? $this->scope["usarSelect"] : null)) {
?>

	<select name="<?php echo $this->scope["name"];?>">
		<?php 
$_fh1_data = (isset($this->scope["opciones"]) ? $this->scope["opciones"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

			<option value="<?php echo $this->scope["item"]["value"];?>" <?php if ((isset($this->scope["item"]["checked"]) ? $this->scope["item"]["checked"]:null)) {
?>selected=""<?php 
}?>><?php echo $this->scope["item"]["label"];?></option>
		<?php 
/* -- foreach end output */
	}
}?>

	</select>
<?php 
}
 /* end template body */
return $this->buffer . ob_get_clean();
?>