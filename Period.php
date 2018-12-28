<?php

class Period extends Entity
{
    private $number;
    private $interval;

    public function __construct(int $number, Interval $interval)
    {
        $this->number = $number;
        $this->interval = $interval;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getInterval(): Interval
    {
        return $this->interval;
    }
}
