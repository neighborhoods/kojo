<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\PDO;

use Neighborhoods\Pylon\Data\Property\Defensive;

class Builder implements BuilderInterface
{
    use Defensive\AwareTrait;
    public const    REGEX_DSN_URI         = '/([^:]+):/';
    protected const PROP_DATA_SOURCE_NAME = 'data_source_name';
    protected const PROP_USER_NAME        = 'user_name';
    protected const PROP_PASSWORD         = 'password';
    protected const PROP_OPTIONS          = 'options';
    protected $_pdo;

    public function getPdo(): \PDO
    {
        if ($this->_pdo === null) {
            $dsn = $this->_getDataSourceName();
            $userName = $this->_getUserName();
            $password = $this->_getPassword();
            if ($this->_hasOptions()) {
                $options = $this->_getOptions();
            }else {
                $options = [];
            }
            $this->_pdo = new \PDO($dsn, $userName, $password, $options);
        }

        return $this->_pdo;
    }

    public function setDataSourceName(string $dataSourceName): BuilderInterface
    {
        $normalizedDataSourceName = preg_replace_callback(self::REGEX_DSN_URI, function ($matches){
            return strtolower($matches[0]);
        }, $dataSourceName, 1);
        $this->_create(self::PROP_DATA_SOURCE_NAME, $normalizedDataSourceName);

        return $this;
    }

    protected function _getDataSourceName(): string
    {
        return $this->_read(self::PROP_DATA_SOURCE_NAME);
    }

    public function setUserName(string $userName): BuilderInterface
    {
        $this->_create(self::PROP_USER_NAME, $userName);

        return $this;
    }

    protected function _getUserName(): string
    {
        return $this->_read(self::PROP_USER_NAME);
    }

    public function setPassword(string $password): BuilderInterface
    {
        $this->_create(self::PROP_PASSWORD, $password);

        return $this;
    }

    protected function _getPassword(): string
    {
        return $this->_read(self::PROP_PASSWORD);
    }

    public function setOptions(array $options): BuilderInterface
    {
        $this->_create(self::PROP_OPTIONS, $options);

        return $this;
    }

    protected function _getOptions(): array
    {
        return $this->_read(self::PROP_OPTIONS);
    }

    protected function _hasOptions(): bool
    {
        return $this->_exists(self::PROP_OPTIONS);
    }
}