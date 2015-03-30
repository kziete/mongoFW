<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="contenedor_tabla">
	<?php if ((isset($this->scope["nav_flag"]) ? $this->scope["nav_flag"] : null)) {
?>

	<div class="pagination">
		<ul>
			<?php if ((isset($this->scope["nav"]) ? $this->scope["nav"] : null)) {
?>

				<li <?php if ((isset($this->scope["actual"]) ? $this->scope["actual"] : null)) {
?>class="active"<?php 
}?>>
					<a href="?p=<?php echo $this->scope["numero"];
if ((isset($this->scope["url"]) ? $this->scope["url"] : null)) {
?>&<?php echo $this->scope["url"];

}?>"><?php echo $this->scope["numero"];?></a>
				</li>
			<?php 
}?>

		</ul>
	</div>
	<?php 
}?>

	<form method="get">
	
		<table class="table table-bordered table-condensed table-striped table-hover tabla_grilla">
			<tr class="cabecera_tabla">
				<?php 
$_fh0_data = (isset($this->scope["cabecera"]) ? $this->scope["cabecera"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

					<th>
						<?php echo $this->scope["item"];?>

					</th>
				<?php 
/* -- foreach end output */
	}
}?>

				<th></th>
			</tr>
			<tr class="filtros">
				<?php 
$_fh1_data = (isset($this->scope["filtros"]) ? $this->scope["filtros"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

				<td><?php echo $this->scope["item"];?></td>
				<?php 
/* -- foreach end output */
	}
}?>

				<td class="td_refre">
					<a href="/admin/<?php echo $this->scope["modelo"];?>" class="btn btn_refrescar">
						<i class="fa fa-refresh"></i> 
					</a>

				<button type="submit" class="btn btn-mini btn-oculto">
					
				</button>
			</td>
			</tr>
			<?php 
$_fh3_data = (isset($this->scope["datos"]) ? $this->scope["datos"] : null);
if ($this->isTraversable($_fh3_data) == true)
{
	foreach ($_fh3_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

			<tr>
				<?php 
$_fh2_data = (isset($this->scope["item"]["outputs"]) ? $this->scope["item"]["outputs"]:null);
if ($this->isTraversable($_fh2_data) == true)
{
	foreach ($_fh2_data as $this->scope['otro'])
	{
/* -- foreach start output */
?>

					<td><?php echo $this->scope["otro"];?></td>
				<?php 
/* -- foreach end output */
	}
}?>

				<td class="iconos_edit">
					<a href="<?php echo $this->scope["item"]["edit"];?>" class="btn_editar h100">
						<i class="fa fa-pencil-square-o"></i>
					</a>
					<?php if (! (isset($this->scope["item"]["bloqueado"]) ? $this->scope["item"]["bloqueado"]:null)) {
?>

					<a href="<?php echo $this->scope["item"]["edit"];?>?borrar=1" class="btn_eliminar h100" onclick="return confirm('Seguro que desea Eliminar?')">
						<i class="fa fa-times"></i>
					</a>
					<?php 
}?>

				</td>
			</tr>
			<?php 
/* -- foreach end output */
	}
}?>

		</table>
	</form>
	<?php if ((isset($this->scope["nav_flag"]) ? $this->scope["nav_flag"] : null)) {
?>

	<div class="pagination">
		<ul>
			<?php 
$_fh4_data = (isset($this->scope["nav"]) ? $this->scope["nav"] : null);
if ($this->isTraversable($_fh4_data) == true)
{
	foreach ($_fh4_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

				<li <?php if ((isset($this->scope["actual"]) ? $this->scope["actual"] : null)) {
?>class="active"<?php 
}?>>
					<a href="?p=<?php echo $this->scope["numero"];
if ((isset($this->scope["url"]) ? $this->scope["url"] : null)) {
?>&<?php echo $this->scope["url"];

}?>"><?php echo $this->scope["numero"];?></a>
				</li>
			<?php 
/* -- foreach end output */
	}
}?>

		</ul>
	</div>
	<?php 
}?>

</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>