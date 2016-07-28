<?php
if (isset($input->options)) {
    foreach ($input->options as $radiooption) {
        $class = explode("\\", get_class($radiooption));
        ?>
        <input name="<?php
        echo $name;
        if ($input->multiple) {
            echo "[]";
        }
        ?>" 
               <?php if (isset($input->type)) { ?> 
                   type="<?php echo $input->type; ?>"
               <?php }; ?> 
               value="<?php echo $radiooption->{"get" . $class[count($class) - 1] . "Id"}(); ?>" 
               <?php if (isset($radiooption->selected)) { ?>
                   checked<?php }; ?>
               > 
        <label><?php echo $radiooption->{"get" . $class[count($class) - 1] . "Name"}(); ?></label>
        <?php
    }
} else {
    ?>
    <input name="<?php
    echo $name;
    if ($input->type == "checkbox") {
        echo "[]";
    }
    ?>" 
           <?php if (isset($input->type)) { ?> 
               type="<?php echo $input->type; ?>"
           <?php }; ?> 
          <?php if(isset($input->hidden)){?> hidden <?php }?> > 
    <?php if(isset($input->hidden)){?>
    <div id="fakecheckbox"></div>
    <?php } ?>
    <label><?php echo $input->label; ?></label>  <?php };?>