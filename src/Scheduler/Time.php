<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Kojo;

class Time implements TimeInterface
{
    use Kojo\Time\AwareTrait;
    const PROP_MINUTES_SCHEDULED_AHEAD_FOR = 'minutes_scheduled_ahead_for';
    protected $referenceDistanceDateTime;
    protected $nextReferenceMinuteDateTime;
    protected $referenceDateTimeClone;
    protected $minutesToScheduleAheadFor;

    public function getReferenceDistanceDateTime(): \DateTime
    {
        if ($this->referenceDistanceDateTime) {
            $minutesToScheduleAheadFor = $this->getMinutesToScheduleAheadFor();
            $minutesToScheduleAheadForDateTimeInterval = new \DateInterval('PT' . $minutesToScheduleAheadFor . 'M');
            $referenceDateTime = $this->getReferenceDateTimeClone();
            $referenceDistanceDateTime = $referenceDateTime->add($minutesToScheduleAheadForDateTimeInterval);

            $this->referenceDistanceDateTime = $referenceDistanceDateTime;
        }

        return $this->referenceDistanceDateTime;
    }

    public function getReferenceDateTimeClone(): \DateTime
    {
        if ($this->referenceDateTimeClone === null) {
            $this->referenceDateTimeClone = $this->getTime()->getNow();
        }

        return clone $this->referenceDateTimeClone;
    }

    public function getNextReferenceMinuteDateTime(): \DateTime
    {
        if ($this->nextReferenceMinuteDateTime === null) {
            $referenceDateTime = $this->getReferenceDateTimeClone();
            $referenceDateTimeMinuteString = $referenceDateTime->format(self::DATE_TIME_FORMAT_MYSQL_MINUTE);
            $nextReferenceMinuteDateTime = new \DateTime($referenceDateTimeMinuteString);
            $this->nextReferenceMinuteDateTime = $nextReferenceMinuteDateTime;
        } else {
            /** @var \DateTime $nextReferenceMinuteDateTime */
            $nextReferenceMinuteDateTime = $this->nextReferenceMinuteDateTime;
            $nextReferenceMinuteDateTime->add(new \DateInterval('PT1M'));
        }

        return clone $this->nextReferenceMinuteDateTime;
    }

    public function getMinutesToScheduleAheadFor(): int
    {
        if ($this->minutesToScheduleAheadFor === null) {
            $this->minutesToScheduleAheadFor = 1;
        }

        return $this->minutesToScheduleAheadFor;
    }

    public function setMinutesToScheduleAheadFor(int $minutesScheduledAheadFor): TimeInterface
    {
        if ($this->minutesToScheduleAheadFor === null) {
            $this->minutesToScheduleAheadFor = $minutesScheduledAheadFor;
        } else {
            throw new \LogicException('Minutes to schedule ahead for is already set.');
        }

        return $this;
    }
}