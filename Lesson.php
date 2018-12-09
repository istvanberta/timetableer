<?php

class Lesson extends Entity
{
    private $subject;
    private $classe;
    private $teacher;
    private $day;
    private $period;

    private $isScheduled = false;

    public function __construct(Subject $subject, Classe $classe)
    {
        $this->subject = $subject;
        $this->classe = $classe;
    }

    public function assignToTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function scheduleFor(Time $time)
    {
        $this->day = $time->getDay();
        $this->period = $time->getPeriod();

        $this->isSchechuled = true;
    }

    public function isScheduled(): bool
    {
        return $this->isScheduled;
    }
}
