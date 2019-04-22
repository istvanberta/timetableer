<?php

namespace Timetableer\Domain;

class Classe extends Entity
{
    private $name;
    private $abbrev;

    public function __construct(string $name, string $abbrev)
    {
        $this->name = $name;
        $this->abbrev = $abbrev;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAbbrev(): string
    {
        return $this->abbrev;
    }
}
