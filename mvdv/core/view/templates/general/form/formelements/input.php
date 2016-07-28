<!--LABEL IF PROVIDED-->
<?php if (isset($input->label)) { ?><label><?php echo $input->label; unset($input->label); ?></label><?php } ?>
<!--BUILD INPUT TAG-->
<input name="<?php echo $name;?>" <?php
foreach ($input as $key => $value) {
    echo $key . '="' . $value . '" ';
}
?> >
