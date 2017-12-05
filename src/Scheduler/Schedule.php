<?php

namespace NHDS\Jobs\Scheduler;

use NHDS\Jobs\TimeInterface;
use NHDS\Jobs\Data\Property\Crud;

class Schedule implements ScheduleInterface
{
    use Crud\AwareTrait;
    const PROP_SCHEDULED_AT          = 'scheduled_at';
    const PROP_CRON_EXPRESSION_PARTS = 'cron_expression_parts';
    const PROP_CREATED_AT            = 'created_at';
    const PROP_JOB_CODE              = 'job_code';

    public function setCronExpression(string $cronExpression): ScheduleInterface
    {
        $cronExpressionParts = preg_split('#\s+#', $cronExpression, null, PREG_SPLIT_NO_EMPTY);
        if (sizeof($cronExpressionParts) < 5 || sizeof($cronExpressionParts) > 6) {
            throw new \InvalidArgumentException('Invalid cron expression: ' . $cronExpression);
        }

        $this->_setCronExpressionParts($cronExpressionParts);

        return $this;
    }

    public function trySchedule(\DateTime $time)
    {
        $cronExpressionParts = $this->_getCronExpressionParts();

        $dateTimeStampParts = getdate($time->format(TimeInterface::MYSQL_DATETIME_FORMAT));

        $match = $this->matchCronExpression($cronExpressionParts[0], $dateTimeStampParts['minutes'])
            && $this->matchCronExpression($cronExpressionParts[1], $dateTimeStampParts['hours'])
            && $this->matchCronExpression($cronExpressionParts[2], $dateTimeStampParts['mday'])
            && $this->matchCronExpression($cronExpressionParts[3], $dateTimeStampParts['mon'])
            && $this->matchCronExpression($cronExpressionParts[4], $dateTimeStampParts['wday']);

        if ($match) {
            $this->setCreatedAt(strftime('%Y-%m-%d %H:%M:%S', time()));
            $this->setScheduledAt(strftime('%Y-%m-%d %H:%M', $time->format(TimeInterface::MYSQL_DATETIME_FORMAT)));
        }

        return $match;
    }

    public function matchCronExpression(string $cronExpression, $num)
    {
        // handle ALL match
        if ($cronExpression === '*') {
            return true;
        }

        // handle multiple options
        if (strpos($cronExpression, ',') !== false) {
            foreach (explode(',', $cronExpression) as $e) {
                if ($this->matchCronExpression($e, $num)) {
                    return true;
                }
            }

            return false;
        }

        // handle modulus
        if (strpos($cronExpression, '/') !== false) {
            $e = explode('/', $cronExpression);
            if (sizeof($e) !== 2) {
                throw new \InvalidArgumentException(
                    "Invalid cron expression, expecting 'match/modulus': " . $cronExpression
                );
            }
            if (!is_numeric($e[1])) {
                throw new \InvalidArgumentException(
                    "Invalid cron expression, expecting numeric modulus: " . $cronExpression
                );
            }
            $cronExpression = $e[0];
            $mod = $e[1];
        }else {
            $mod = 1;
        }

        // handle all match by modulus
        if ($cronExpression === '*') {
            $from = 0;
            $to = 60;
        }// handle range
        elseif (strpos($cronExpression, '-') !== false) {
            $e = explode('-', $cronExpression);
            if (sizeof($e) !== 2) {
                throw new \InvalidArgumentException(
                    "Invalid cron expression, expecting 'from-to' structure: " . $cronExpression
                );
            }

            $from = $this->getNumeric($e[0]);
            $to = $this->getNumeric($e[1]);
        }// handle regular token
        else {
            $from = $this->getNumeric($cronExpression);
            $to = $from;
        }

        if ($from === false || $to === false) {
            throw new \InvalidArgumentException("Invalid cron expression: " . $cronExpression);
        }

        return ($num >= $from) && ($num <= $to) && ($num % $mod === 0);
    }

    public function getNumeric($value)
    {
        static $data = array(
            'jan' => 1,
            'feb' => 2,
            'mar' => 3,
            'apr' => 4,
            'may' => 5,
            'jun' => 6,
            'jul' => 7,
            'aug' => 8,
            'sep' => 9,
            'oct' => 10,
            'nov' => 11,
            'dec' => 12,
            'sun' => 0,
            'mon' => 1,
            'tue' => 2,
            'wed' => 3,
            'thu' => 4,
            'fri' => 5,
            'sat' => 6,
        );

        if (is_numeric($value)) {
            return $value;
        }

        if (is_string($value)) {
            $value = strtolower(substr($value, 0, 3));
            if (isset($data[$value])) {
                return $data[$value];
            }
        }

        return false;
    }

    protected function _setCronExpressionParts(array $cronExpressionParts): ScheduleInterface
    {
        $this->_create(self::PROP_CRON_EXPRESSION_PARTS, $cronExpressionParts);

        return $this;
    }

    protected function _getCronExpressionParts(): array
    {
        return $this->_read(self::PROP_CRON_EXPRESSION_PARTS);
    }

    protected function setCreatedAt(string $createdAt): ScheduleInterface
    {
        $this->_create(self::PROP_CREATED_AT, $createdAt);

        return $this;
    }

    protected function setScheduledAt(string $scheduleAt): ScheduleInterface
    {
        $this->_create(self::PROP_SCHEDULED_AT, $scheduleAt);

        return $this;
    }

    public function setJobCode(string $jobCode): ScheduleInterface
    {
        $this->_create(self::PROP_JOB_CODE, $jobCode);

        return $this;
    }

    public function getScheduledAt(): string
    {
        return $this->_read(self::PROP_SCHEDULED_AT);
    }
}
