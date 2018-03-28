<?php
declare(strict_types=1);

namespace Neighborhoods\Toolkit\Time;

use Neighborhoods\Toolkit\TimeInterface;

trait AwareTrait
{
    protected $_time ;

    public function setTime(TimeInterface $time)
    {
        if ($this->_time === null) {
            $this->_time = $time;
        }else {
            throw new \Exception('Time is already set.');
        }

        return $this;
    }

    protected function _getTime(): TimeInterface
    {
        if ($this->_time === null) {
            throw new \LogicException('Time is not set.');
        }

        return $this->_time;
    }
}