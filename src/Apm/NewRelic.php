<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Apm;

class NewRelic implements NewRelicInterface
{
    /** @var string */
    protected $applicationName;

    public function setApplicationName(string $applicationName): NewRelicInterface
    {
        if ($this->applicationName === null) {
            $this->applicationName = $applicationName;
        } else {
            throw new \LogicException('NewRelic applicationName is already set.');
        }


        return $this;
    }

    protected function getApplicationName(): string
    {
        if ($this->applicationName === null) {
            $this->setApplicationName(ini_get("newrelic.appname"));
        }

        return $this->applicationName;
    }

    public function startTransaction(): NewRelicInterface
    {
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_start_transaction($this->getApplicationName());
        }

        return $this;
    }

    public function endTransaction(): NewRelicInterface
    {
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_end_transaction();
        }

        return $this;
    }

    public function ignoreTransaction(): NewRelicInterface
    {
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_ignore_transaction();
        }

        return $this;
    }

    public function nameTransaction(string $name): NewRelicInterface
    {
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_name_transaction($name);
        }

        return $this;
    }

    public function addCustomParameter(string $key, $value): NewRelicInterface
    {
        if (!is_scalar($value)) {
            throw new \InvalidArgumentException("Value is not a scalar.");
        }
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_add_custom_parameter($key, $value);
        }

        return $this;
    }
}