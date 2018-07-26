<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface TimeInterface
{
    public const DEFAULT_TIMEZONE_CODE = 'UTC';
    public const MYSQL_DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    public const MICRO_TIME = 'Uu';

    public function getNow(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTime;

    public function getUnixReferenceTimeNow(): string;

    public function validateTimestamp(string $timestamp, string $format = TimeInterface::MYSQL_DATE_TIME_FORMAT): bool;

    public function getDateTimeZone(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTimeZone;

    public function getNewDateInterval(string $intervalSpec): \DateInterval;
}