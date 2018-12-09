<?php

class Classe extends Entity
{
    private $abbrev;
    private $name;

    public function __construct(string $abbrev, string $name)
    {
        $this->abbrev = $abbrev;
        $this->name = $name;
    }
}
