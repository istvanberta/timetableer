<?php

namespace Timetableer;

class Group extends Entity
{
    private $name;
    private $classe;
    private $grouptag;

    public function __construct(string $name, Classe $classe)
    {
        $this->name = $name;
        $this->classe = $classe;
    }

    public function getName()
    {
        return $this->name;
    }
}
