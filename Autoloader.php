<?php

class Autoloader
{
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass(string $classname)
    {
        if ($this->isNamespaced($classname)) {
            $classname = $this->stripNamespacePrefix($classname);
        }

        $filename = __DIR__ . "/" . "{$classname}.php";

        if (file_exists($filename)) {
            require $filename;
        }
    }

    private function isNamespaced(string $classname): bool
    {
        return (bool) strpos($classname, '\\');
    }

    private function stripNamespacePrefix(string $classname): string
    {
        return substr($classname, strrpos($classname, '\\') + 1);
    }
}
