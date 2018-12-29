<?php

class Teacher extends Entity
{
    private $name;
    private $acronym;

    public function __construct(Name $name)
    {
        $this->name = $name;
        $this->acronym = $name->acronym();
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setAcronym(string $acronym)
    {
        $this->acronym = $acronym;
    }

    public function getAcronym(): string
    {
        return $this->acronym;
    }
}
