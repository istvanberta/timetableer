<?php

class Subject extends Entity
{
    private $abbrev;
    private $name;

    public function __construct(string $abbrev, string $name)
    {
        $this->abbrev = $abbrev;
        $this->name = $name;
    }

    public function getAbbrev()
    {
        return $this->abbrev;
    }

    public function getName()
    {
        return $this->name;
    }
}
