<?php

namespace NHDS\Jobs\Scheduler;

interface ScheduleInterface
{
    public function setCronExpression(string $cronExpression): ScheduleInterface;

    public function trySchedule(\DateTime $time);

    public function matchCronExpression(string $cronExpression, $num);

    public function getNumeric($value);

    public function setJobCode(string $jobCode): ScheduleInterface;
}