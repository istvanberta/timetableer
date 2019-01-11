<?php

namespace Timetableer;

class Classe extends Entity
{
    private $name;
    private $abbrev;

    public function __construct(string $name, string $abbrev)
    {
        $this->name = $name;
        $this->abbrev = $abbrev;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAbbrev()
    {
        return $this->abbrev;
    }
}
