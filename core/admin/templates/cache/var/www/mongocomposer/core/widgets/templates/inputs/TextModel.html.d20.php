<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><input type="text" placeholder="<?php echo $this->scope["placeholder"];?>" name="<?php echo $this->scope["name"];?>" value="<?php echo $this->scope["value"];?>"><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>