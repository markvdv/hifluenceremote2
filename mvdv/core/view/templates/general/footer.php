</div>
<footer>
    <div class="container">
    </div>
</footer>
<!-- FOOTERSCRIPTS-->
<?php foreach (self::$js['footer'] as $key => $scriptsource) { ?>
    <!--<?php echo $key; ?> --><?php echo PHP_EOL; ?>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/scripttag.php"; ?> 
<?php } ?>
</body>
</html>