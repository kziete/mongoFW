<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
if ((isset($this->scope["value"]) ? $this->scope["value"] : null)) {
?>

<a href="/archivos/<?php echo $this->scope["value"];?>" target="_blank"><?php echo $this->scope["value"];?></a> <br>
<input type="hidden" name="file_<?php echo $this->scope["name"];?>" value="<?php echo $this->scope["value"];?>">

<?php 
}?>

<input type="file" placeholder="<?php echo $this->scope["placeholder"];?>" name="<?php echo $this->scope["name"];?>" value="<?php echo $this->scope["value"];?>"><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>