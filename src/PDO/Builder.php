<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO;

class Builder implements BuilderInterface
{
    public const REGEX_DSN_URI = '/([^:]+):/';
    protected $pdo;
    protected $dataSourceName;
    protected $userName;
    protected $password;
    protected $options;

    public function getPdo(): \PDO
    {
        if ($this->pdo === null) {
            $dsn = $this->getDataSourceName();
            $userName = $this->getUserName();
            $password = $this->getPassword();
            if ($this->hasOptions()) {
                $options = $this->getOptions();
            } else {
                $options = [];
            }
            $this->pdo = new \PDO($dsn, $userName, $password, $options);
        }

        return $this->pdo;
    }

    public function setDataSourceName(string $dataSourceName): BuilderInterface
    {
        if ($this->dataSourceName === null) {
            $normalizedDataSourceName = preg_replace_callback(self::REGEX_DSN_URI, function ($matches) {
                return strtolower($matches[0]);
            }, $dataSourceName, 1);
            $this->dataSourceName = $normalizedDataSourceName;
        } else {
            throw new \LogicException('Data source name is already set.');
        }

        return $this;
    }

    protected function getDataSourceName(): string
    {
        if ($this->dataSourceName === null) {
            throw new \LogicException('Data source name is not set.');
        }

        return $this->dataSourceName;
    }

    public function setUserName(string $userName): BuilderInterface
    {
        if ($this->userName === null) {
            $this->userName = $userName;
        } else {
            throw new \LogicException('User name is already set.');
        }

        return $this;
    }

    protected function getUserName(): string
    {
        if ($this->userName === null) {
            throw new \LogicException('User name is not set.');
        }

        return $this->userName;
    }

    public function setPassword(string $password): BuilderInterface
    {
        if ($this->password === null) {
            $this->password = $password;
        } else {
            throw new \LogicException('Password is already set.');
        }

        return $this;
    }

    protected function getPassword(): string
    {
        if ($this->password == null) {
            throw new \LogicException('Password is not set.');
        }

        return $this->password;
    }

    public function setOptions(array $options): BuilderInterface
    {
        if ($this->options === null) {
            $this->options = $options;
        } else {
            throw new \LogicException('Options is already set.');
        }

        return $this;
    }

    protected function getOptions(): array
    {
        if (!$this->hasOptions()) {
            throw new \LogicException('Options is not set.');
        }

        return $this->options;
    }

    protected function hasOptions(): bool
    {
        return $this->options === null ? false : true;
    }
}