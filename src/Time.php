<?php

namespace NHDS\Jobs;

class Time implements TimeInterface
{
    protected $_dateTimeZones = array();

    public function getNow(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTime
    {
        $microTime = explode('.', sprintf('%.06f', microtime(true)));
        $time = gmdate(self::MYSQL_DATETIME_FORMAT . '.' . $microTime[1], $microTime[0]);
        $now = new \DateTime($time, new \DateTimeZone('GMT'));
        $now->setTimezone($this->getDateTimeZone($timezoneCode));

        return $now;
    }

    public function getUnixReferenceTimeNow(): string
    {
        return sprintf('%.16f', microtime(true));
    }

    public function validateTimestamp(string $timestamp, string $format = TimeInterface::MYSQL_DATETIME_FORMAT): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $timestamp);

        return $dateTime && $dateTime->format($format) == $timestamp;
    }

    public function getDateTimeZone(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTimeZone
    {
        if (!isset($this->_dateTimeZones[$timezoneCode])) {
            $dateTimeZone = new \DateTimeZone($timezoneCode);
            $this->_dateTimeZones[$timezoneCode] = $dateTimeZone;
        }

        return clone $this->_dateTimeZones[$timezoneCode];
    }
}