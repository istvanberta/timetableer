<?php

class LessonCollection implements Iterator
{
    private $position;
    private $lessons;

    public function __construct()
    {
        $this->position = 0;
        $this->lessons = [];
    }

    public function add(Lesson $lesson)
    {
        $this->lessons[] = $lesson;
    }

    public function current()
    {
        return $this->lessons[$this->position];
    }

    public function key()
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

    public function valid()
    {
        return isset($this->lessons[$this->position]);
    }
}
