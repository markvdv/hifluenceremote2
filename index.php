<?php
$debug=false;
set_include_path(\get_include_path().PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT']."/custompagecontrollers/");
spl_autoload_register();
new \MVDV\Core\App\Bootstrap($_SERVER['REQUEST_URI']);
exit(0);