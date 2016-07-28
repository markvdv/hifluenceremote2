<?php ?>
<label><?php echo $name; ?></label>
<select name="<?php echo $input->name; ?>"  <?php if (isset($input->multiple)) { ?><?php }; ?> <?php if (isset($input->multiple)) { ?>multiple <?php };
if (isset($input->required)) {
    ?>required <?php }; ?>>
            <?php $class = explode("\\", get_class($input->options[key($input->options)])); ?>
        <?php foreach ($input->options as $key => $entity) { ?>
        <option value="<?php echo $key; ?>" <?php if (isset($entity->selected)) { ?>selected<?php } ?>>
        <?php echo $entity->{"get" . $class[count($class) - 1] . "Name"}(); ?>
        </option>
<?php } ?>
</select>
<span class="formelementerror"><?php if (isset($input->errormsg)) { ?><ul><?php foreach ($input->errormsg as $key => $value) { ?><li> <?php echo $input->errormsg; ?> </li> <?php
                                             } ?></ul><?php } ?></span>
