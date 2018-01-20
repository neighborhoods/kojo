<?php
declare(strict_types=1);

namespace NHDS\Jobs\Scheduler;

interface TimeInterface
{
    const DATE_TIME_FORMAT_MYSQL_MINUTE        = 'Y-m-d H:i:0';
    const PROP_NEXT_REFERENCE_MINUTE_DATE_TIME = 'next_reference_minute_date_time';
    const PROP_REFERENCE_DATE_TIME_CLONE       = 'reference_date_time_clone';

    public function getReferenceDistanceDateTime(): \DateTime;

    public function getReferenceDateTimeClone(): \DateTime;

    public function getNextReferenceMinuteDateTime(): \DateTime;

    public function getMinutesToScheduleAheadFor(): int;

    public function setMinutesToScheduleAheadFor(int $minutesScheduledAheadFor): TimeInterface;
}