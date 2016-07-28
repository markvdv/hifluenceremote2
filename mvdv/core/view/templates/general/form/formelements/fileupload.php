<!--LABEL IF PROVIDED-->
<?php if (isset($input->label)) { ?><label><?php echo $input->label; ?></label><?php } ?>
<!--BUILD INPUT TAG-->
<?php if (isset($input->hidden)) { ?>
    <div id="uploadbutton">
        <div class="imgholder" >
            <img <?php if ($input->imgbuttonsrc) { ?> src="<?php echo $input->imgbuttonsrc; ?>">
                <?php unset($input->imgbuttonsrc); ?>
            </div>
        </div>
    <?php }
    
    unset($input->hidden);
}
?>
<input name="<?php echo $name ?>" <?php
foreach ($input as $key => $value) {
    if ($key !== "tag") {
        echo $key . '="' . $value . '" ';
    }
}
?>>
