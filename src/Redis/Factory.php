<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Defensive\AwareTrait;
    protected $_options = [];

    public function create(): \Redis
    {
        $redis = new \Redis();
        $redis->connect($this->_getHost(), $this->_getPort());
        if ($this->_hasOptions()) {
            foreach ($this->_getOptions() as $optionName => $optionValue) {
                $redis->setOption($optionName, $optionValue);
            }
        }

        return $redis;
    }

    public function setPort(int $port): FactoryInterface
    {
        $this->_create(self::PROP_PORT, $port);

        return $this;
    }

    protected function _getPort(): int
    {
        return $this->_read(self::PROP_PORT);
    }

    public function setHost(string $host): FactoryInterface
    {
        $this->_create(self::PROP_HOST, $host);

        return $this;
    }

    protected function _getHost(): string
    {
        return $this->_read(self::PROP_HOST);
    }

    public function addOption(int $optionName, string $optionValue): FactoryInterface
    {
        if (isset($this->_options[$optionName])) {
            $optionValue = $this->_options[$optionName];
            throw new \LogicException("Option [$optionName] is already set with value [$optionValue].");
        }

        $this->_options[$optionName] = $optionValue;

        return $this;
    }

    protected function _hasOptions(): bool
    {
        return !empty($this->_options);
    }

    protected function _getOptions(): array
    {
        return $this->_options;
    }
}