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
}
