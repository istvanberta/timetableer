<?php

class Teacher
{
    public $id;
    public $firstName;
    public $lastName;

    public function __construct(string $firstName, string $lastName, int $id = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
    }

    public function getFullName(): string
    {
        return $this->lastName . ' ' . $this->firstName;
    }
}