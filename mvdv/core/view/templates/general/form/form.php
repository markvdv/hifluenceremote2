<form action="<?php echo $this->action; ?>" method="<?php echo $this->method; ?>" <?php foreach($this->dataattributes as $key =>$value){?> data-<?php echo $key ?>="<?php echo $value?>"<?php }?> <?php foreach($this->formattributes as $key =>$value){?> <?php echo $key ?>="<?php echo $value?>"<?php }?>>
    <?php
    foreach ($this->inputs as $name => $input) {
        $selected = null;
        if (isset($input->selected)) {
            $selected = $input->selected;
        }
        $class= get_called_class();
       // $class= get_called_class();
        $class::createFormElement($input, $name, $selected);
    }
    ?>
</form>
<div class="msg">
</div>

