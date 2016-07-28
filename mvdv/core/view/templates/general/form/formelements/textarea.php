<textarea name="<?php echo $input->name; ?>" <?php if (isset($input->placeholder)) { ?> placeholder="<?php echo $input->placeholder; ?>" <?php }; ?>><?php
    if (isset($input->value)) {
        echo $input->value;
    }
    ?>
</textarea>
<span class="formelementerror"><?php if (isset($input->errormsg)) { ?><ul><?php foreach ($input->errormsg as $key => $value) { ?><li> <?php echo $input->errormsg; ?> </li> <?php
                                             } ?></ul><?php } ?></span>
