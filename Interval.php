<?php

class Interval
{
    private $startTime;
    private $endTime;

    public function __construct(string $startTime, string $endTime)
    {
        $this->startTime = strtotime($startTime);
        $this->endTime = strtotime($endTime);
    }

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function getEndTime(): int
    {
        return $this->endTime;
    }
}
