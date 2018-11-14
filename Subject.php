<?php

class Subject
{
    public $abbrev;
    public $name;

    public function __construct(string $abbrev, string $name)
    {
        $this->abbrev = $abbrev;
        $this->name = $name;
    }
}