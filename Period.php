<?php

class Period
{
    public $id;
    public $period;
    public $startTime;
    public $endTime;

    public function __construct(
        string $period,
        int $startTime,
        int $endtime,
        int $id = null
    ) {
        $this->period = $period;
        $this->startTime = $startTime;
        $this->endtime = $endTime;
        $this->id = $id;
    }
}