<?php

class Timetable extends LessonCollection
{
    private $classe;

    public function __construct(Classe $classe)
    {
        $this->classe = $classe;
        parent::__construct();
    }
}
