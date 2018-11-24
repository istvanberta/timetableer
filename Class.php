<?php

class Class
{
    public $id;
    public $abbrev;
    public $name;

    public function __construct(string $abbrev, string $name, int $id = null)
    {
        $this->abbrev = $abbrev;
        $this->name = $name;
        $this->id = $id;
    }
}