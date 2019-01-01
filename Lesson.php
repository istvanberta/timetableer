<?php

class Lesson extends Entity
{
    private $subject;
    private $classe;
    private $teacher;
    private $timeslot;

    private $isScheduled = false;
    private $hasTeacher = false;

    public function __construct(Subject $subject, Classe $classe)
    {
        $this->subject = $subject;
        $this->classe = $classe;
    }

    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function getClasse(): Classe
    {
        return $this->classe;
    }

    public function assignToTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
        $this->hasTeacher = true;
    }

    public function hasTeacher(): bool
    {
        return $this->hasTeacher;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function scheduleFor(Timeslot $timeslot)
    {
        $this->timeslot = $timeslot;
        $this->isSchechuled = true;
    }

    public function isScheduled(): bool
    {
        return $this->isScheduled;
    }

    public function getTimeslot(): ?Timeslot
    {
        return $this->timeslot;
    }
}
