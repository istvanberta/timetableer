<?php

namespace Timetableer;

abstract class Entity
{
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
