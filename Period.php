<?php

class Period
{
    public $id;
    public $period;
    public $startTime;
    public $endTime;

    public function __construct(
        string $period,
        string $startTime,
        string $endTime,
        int $id = null
    ) {
        $this->period = $period;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->id = $id;
    }
}