<?php

class Teacher extends Entity
{
    private $name;
    private $abbrev;

    public function __construct(Name $name)
    {
        $this->name = $name;
    }

    public function setAbbrev(string $abbrev)
    {
        $this->abbrev = $abbrev;
    }
}
