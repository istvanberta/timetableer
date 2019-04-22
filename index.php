<?php

require __DIR__ . '/src/Autoloader.php';

$loader = new Timetableer\Autoloader();
$loader->register();
$loader->addDir(__DIR__.'/src/', 'Timetableer');
