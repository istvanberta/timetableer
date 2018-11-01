<?php

class Teacher
{
    private $id;
    private $firstName;
    private $lastName;

    public function __construct(string $firstName, string $lastName, int $id = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
    }

    public function getName()
    {
        return $this->lastName . ' ' . $this->firstName;
    }
}