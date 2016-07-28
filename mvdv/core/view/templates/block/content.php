<div id="content">
    <?php
    foreach ($this->data['blocks'] as $blockname) {
        self::getIdmap()[$blockname]->render();
    }
    ?>
</div>