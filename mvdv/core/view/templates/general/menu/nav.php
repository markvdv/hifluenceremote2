<nav <?php if (isset($this->containerid)) { ?> id="<?php echo $this->containerid; ?>" <?php } ?>>
    <?php foreach ($this->links as $name => $link) { ?>
        <a href="<?php echo $link['url']; ?>" <?php if (isset($link['dataattributes'])) {
            foreach ($link['dataattributes'] as $key => $value) {
                ?>
                   data-<?php echo $key; ?>="<?php echo $value; ?>" 
        <?php }} ?> ><?php echo $name; ?></a>
<?php } ?>
</nav>