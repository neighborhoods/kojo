<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Apm;

use Neighborhoods\Pylon\Data\Property;

class NewRelic implements NewRelicInterface
{
    use Property\Defensive\AwareTrait;
    protected const PROP_APPLICATION_NAME = 'application_name';

    public function setApplicationName(string $applicationName): NewRelicInterface
    {
        $this->_create(self::PROP_APPLICATION_NAME, $applicationName);

        return $this;
    }

    protected function _getApplicationName(): string
    {
        if (!$this->_exists(self::PROP_APPLICATION_NAME)) {
            $this->_create(self::PROP_APPLICATION_NAME, ini_get("newrelic.appname"));
        }

        return $this->_read(self::PROP_APPLICATION_NAME);
    }

    public function startTransaction(): NewRelicInterface
    {
        if (extension_loaded(self::NEW_RELIC_EXTENSION_NAME)) {
            newrelic_start_transaction($this->_getApplicationName());
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