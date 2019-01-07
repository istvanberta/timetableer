<?php

$basicAutoloader = function ($classname) {
    $file = __DIR__ . "/" . "{$classname}.php";
    if (file_exists($file)) {
        require_once($file);
    }
};

spl_autoload_register($basicAutoloader);