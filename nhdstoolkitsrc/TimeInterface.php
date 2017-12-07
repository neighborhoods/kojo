<?php

namespace NHDS\Toolkit;

interface TimeInterface
{
    const DEFAULT_TIMEZONE_CODE = 'UTC';
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const MICRO_TIME            = 'Uu';

    public function getNow(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTime;

    public function getUnixReferenceTimeNow(): string;

    public function validateTimestamp(string $timestamp, string $format = TimeInterface::MYSQL_DATETIME_FORMAT): bool;

    public function getDateTimeZone(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTimeZone;
}