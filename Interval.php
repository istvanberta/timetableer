<?php

class Interval
{
    private $startTime;
    private $endTime;

    public function __construct(int $startTime, int $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
}
