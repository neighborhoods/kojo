<?php
declare(strict_types=1);

namespace NHDS\Watch\PHPUnit\DbUnit\DataSet;

use PHPUnit\DbUnit\DataSet\IYamlParser;
use Symfony\Component\Yaml\Yaml;
use NHDS\Toolkit\Data\Property\Strict;

class SymfonyYamlParser implements IYamlParser
{
    use Strict\AwareTrait;
    const PROP_FLAGS = 'flags';

    public function setFlags(int $flags): SymfonyYamlParser
    {
        $this->_create(self::PROP_FLAGS, $flags);

        return $this;
    }

    protected function _getFlags()
    {
        return $this->_read(self::PROP_FLAGS);
    }

    public function parseYaml($yamlFile)
    {
        return Yaml::parse(\file_get_contents($yamlFile), $this->_getFlags());
    }
}