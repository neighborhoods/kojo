<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Apm;

interface NewRelicInterface
{
    public const NEW_RELIC_EXTENSION_NAME = 'newrelic';

    public function setApplicationName(string $applicationName): NewRelicInterface;

    public function startTransaction(): NewRelicInterface;

    public function endTransaction(): NewRelicInterface;

    public function nameTransaction(string $name): NewRelicInterface;

    public function addCustomParameter(string $key, $value): NewRelicInterface;

    public function ignoreTransaction(): NewRelicInterface;
}