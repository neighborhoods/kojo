<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

use Neighborhoods\Toolkit\Data\Property\Strict;

abstract class FactoryAbstract implements FactoryInterface
{
    use Strict\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function setName(string $factoryName): FactoryInterface
    {
        $this->_create(self::PROP_FACTORY_NAME, $factoryName);

        return $this;
    }

    public function getName(): string
    {
        return $this->_read(self::PROP_FACTORY_NAME);
    }
}