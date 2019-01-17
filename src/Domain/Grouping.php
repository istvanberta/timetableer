<?php

namespace Timetableer;

class Grouping implements \Iterator
{
    private $groups;
    private $position;

    public function __construct()
    {
        $this->groups = [];
        $this->position = 0;
    }

    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    public function current(): Group
    {
        return $this->groups[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->groups[$this->position]);
    }
}
