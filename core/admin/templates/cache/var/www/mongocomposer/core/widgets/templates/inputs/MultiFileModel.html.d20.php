<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><input type="file" id="fileupload-<?php echo $this->scope["name"];?>"  name="files[]" data-url="/admin_assets/jqueryupload/server/php/" multiple >
<input name="<?php echo $this->scope["name"];?>" type="hidden" id="hidden-<?php echo $this->scope["name"];?>" value="<?php echo $this->scope["value"];?>">
<div class="progress progress-striped active hide" id="bar-<?php echo $this->scope["name"];?>" >
	<div class="bar"></div>
</div>

<div id="contenedor-<?php echo $this->scope["name"];?>">
</div>

<script type="text/javascript">
$(document).ready(function(){
	new MultiFile('<?php echo $this->scope["name"];?>');
});
</script>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>