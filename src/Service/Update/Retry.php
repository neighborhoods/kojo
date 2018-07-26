<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

class Retry implements RetryInterface
{
    /** @var \DateTime */
    protected $dateTime;

    public function save(): RetryInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestRetry($this->getDateTime());
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        if ($this->dateTime === null) {
            throw new \LogicException('Retry dateTime has not been set.');
        }

        return $this->dateTime;
    }

    public function setDateTime(\DateTime $dateTime): RetryInterface
    {
        if ($this->dateTime !== null) {
            throw new \LogicException('Retry dateTime is already set.');
        }
        $this->dateTime = $dateTime;

        return $this;
    }
    
}