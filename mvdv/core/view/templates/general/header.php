<!DOCTYPE HTML>
<html>
    <head>
        <!--css files-->
        <title>
            <?php echo $this->data['title']; ?>
        </title>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <META name="description" CONTENT="<?php echo $this->data["description"] ?>">
        <META name="keywords" CONTENT="<?php echo $this->data["keywords"] ?>">
        


<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        
        <!-- voor translation later <META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en-US,fr">-->       
              <?php
              foreach (self::$css as $csssource) {
                  //include $_SERVER['DOCUMENT_ROOT'] . "/mvdv/" . strtolower($namespace) . "/templates/general/stylesheettag.php";
                  include $_SERVER['DOCUMENT_ROOT'] . "/mvdv/core/view/templates/general/stylesheettag.php";
              }
              foreach (self::$js['header'] as $scriptsource) {
                  include $_SERVER['DOCUMENT_ROOT'] . "/mvdv/core/view/templates/general/scripttag.php";
              }
              ?>
    </head>
    <body>
        <header>
            <div class="container">
                <!--here goes header shit :) so something like echo this->dataheadermenu-->
            </div>
        </header>
        <div class="container" id="container">