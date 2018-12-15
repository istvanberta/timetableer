<?php

class Timeslot
{
    private $day;
    private $period;

    public function __construct(string $day, Period $period)
    {
        $this->day = $day;
        $this->period = $period;
    }
}