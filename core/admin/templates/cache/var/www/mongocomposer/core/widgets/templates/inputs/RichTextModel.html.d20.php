<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><textarea placeholder="<?php echo $this->scope["placeholder"];?>" name="<?php echo $this->scope["name"];?>" id="<?php echo $this->scope["name"];?>"><?php echo $this->scope["value"];?></textarea>
<script type="text/javascript">
tinymce.init({
    selector: "#<?php echo $this->scope["name"];?>",
    plugins: ["code"]
 });
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>