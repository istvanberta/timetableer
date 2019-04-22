<?php

namespace Timetableer;

class Autoloader
{
    private $directories = array();

    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function addDir(string $baseDir, string $prefix) {
        // normalizing
        $baseDir = rtrim($baseDir, '/') . '/';

        $this->directories[$prefix][] = $baseDir;
    }

    public function loadClass(string $classname)
    {
        $prefixes = $this->matchingPrefixes($this->prefixCandids($classname));
        $filepaths = $this->filepathCandids($classname, $prefixes);

        foreach ($filepaths as $filepath) {
            if (is_file($filepath)) {
                require $filepath;
                return;
            }
        }
    }

    private function prefixCandids(string $classname): array
    {
        $prefixCandids = [];

        while (false !== $pos = strrpos($classname, '\\')) {
            $classname = substr($classname, 0, $pos);
            $prefixCandids[] = $classname;
        }

        return $prefixCandids;
    }

    private function matchingPrefixes(array $prefixCandids): array
    {
        $matchingPrefixes = [];

        foreach ($prefixCandids as $prefixCandid) {
            if (array_key_exists($prefixCandid, $this->directories)) {
                $matchingPrefixes[] = $prefixCandid;
            }
        }

        return $matchingPrefixes;
    }

    private function filepathCandids(string $classname, array $prefixes): array
    {
        $filepathCandids = [];

        foreach ($prefixes as $prefix) {
            foreach($this->directories[$prefix] as $dir) {
                $rightpart = str_replace('\\', '/', substr($classname, strlen($prefix) + 1));
                $filepathCandids[] = $dir . $rightpart . '.php';
            }
        }

        $filepathCandids[] = str_replace('\\', '/', $classname) . '.php';

        return $filepathCandids;
    }
}
