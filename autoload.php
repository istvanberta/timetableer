<?php

$basicAutoloader = function ($classname) {
    $pos = strpos($classname, '\\'); // find namespace prefix end
    $classname = substr($classname, $pos + 1); //strip namespace prefix
    $file = __DIR__ . "/" . "{$classname}.php";
    if (file_exists($file)) {
        require($file);
    }
};

spl_autoload_register($basicAutoloader);
