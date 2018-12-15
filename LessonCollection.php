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

    public function current(): Lesson
    {
        return $this->lessons[$this->position];
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
        return isset($this->lessons[$this->position]);
    }
}
