<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Pylon;

class Time implements TimeInterface
{
    use Strict\AwareTrait;
    use Toolkit\Time\AwareTrait;
    const PROP_MINUTES_SCHEDULED_AHEAD_FOR  = 'minutes_scheduled_ahead_for';
    const PROP_REFERENCE_DISTANCE_DATE_TIME = 'reference_distance_date_time';

    public function getReferenceDistanceDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DISTANCE_DATE_TIME)) {
            $minutesToScheduleAheadFor = $this->getMinutesToScheduleAheadFor();
            $minutesToScheduleAheadForDateTimeInterval = new \DateInterval('PT' . $minutesToScheduleAheadFor . 'M');
            $referenceDateTime = $this->getReferenceDateTimeClone();
            $referenceDistanceDateTime = $referenceDateTime->add($minutesToScheduleAheadForDateTimeInterval);

            $this->_create(self::PROP_REFERENCE_DISTANCE_DATE_TIME, $referenceDistanceDateTime);
        }

        return $this->_read(self::PROP_REFERENCE_DISTANCE_DATE_TIME);
    }

    public function getReferenceDateTimeClone(): \DateTime
    {
        if (!$this->_exists(self::PROP_REFERENCE_DATE_TIME_CLONE)) {
            $this->_create(self::PROP_REFERENCE_DATE_TIME_CLONE, $this->_getTime()->getNow());
        }

        return clone $this->_read(self::PROP_REFERENCE_DATE_TIME_CLONE);
    }

    public function getNextReferenceMinuteDateTime(): \DateTime
    {
        if (!$this->_exists(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME)) {
            $referenceDateTime = $this->getReferenceDateTimeClone();
            $referenceDateTimeMinuteString = $referenceDateTime->format(self::DATE_TIME_FORMAT_MYSQL_MINUTE);
            $nextReferenceMinuteDateTime = new \DateTime($referenceDateTimeMinuteString);
            $this->_create(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME, $nextReferenceMinuteDateTime);
        }else {
            /** @var \DateTime $nextReferenceMinuteDateTime */
            $nextReferenceMinuteDateTime = $this->_read(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME);
            $nextReferenceMinuteDateTime->add(new \DateInterval('PT1M'));
        }

        return clone $this->_read(self::PROP_NEXT_REFERENCE_MINUTE_DATE_TIME);
    }

    public function getMinutesToScheduleAheadFor(): int
    {
        if (!$this->_exists(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR)) {
            $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, 1);
        }

        return $this->_read(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR);
    }

    public function setMinutesToScheduleAheadFor(int $minutesScheduledAheadFor): TimeInterface
    {
        $this->_create(self::PROP_MINUTES_SCHEDULED_AHEAD_FOR, $minutesScheduledAheadFor);

        return $this;
    }
}