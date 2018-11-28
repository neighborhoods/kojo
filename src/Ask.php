<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class Ask implements AskInterface
{
    protected $where;
    protected $factory_fqcn;
    protected $builder_fqcn;
    protected $with;

    public function getWhere(): WhereInterface
    {
        if ($this->where === null) {
            throw new \LogicException('Ask where has not been set.');
        }

        return $this->where;
    }

    public function setWhere(WhereInterface $where): AskInterface
    {
        if ($this->where !== null) {
            throw new \LogicException('Ask where is already set.');
        }
        $this->where = $where;

        return $this;
    }

    public function hasWhere(): bool
    {
        return $this->where !== null;
    }

    public function getFactoryFQCN(): string
    {
        if ($this->factory_fqcn === null) {
            throw new \LogicException('Ask factory_fqcn has not been set.');
        }

        return $this->factory_fqcn;
    }

    public function setFactoryFQCN(string $factory_fqcn): AskInterface
    {
        if ($this->factory_fqcn !== null) {
            throw new \LogicException('Ask factory_fqcn is already set.');
        }
        $this->factory_fqcn = $factory_fqcn;

        return $this;
    }

    public function hasFactoryFQCN(): bool
    {
        return $this->factory_fqcn !== null;
    }

    public function getBuilderFQCN(): string
    {
        if ($this->builder_fqcn === null) {
            throw new \LogicException('Ask builder_fqcn has not been set.');
        }

        return $this->builder_fqcn;
    }

    public function setBuilderFQCN(string $builder_fqcn): AskInterface
    {
        if ($this->builder_fqcn !== null) {
            throw new \LogicException('Ask builder_fqcn is already set.');
        }
        $this->builder_fqcn = $builder_fqcn;

        return $this;
    }

    public function hasBuilderFQCN(): bool
    {
        return $this->builder_fqcn !== null;
    }

    public function getWith(): array
    {
        if ($this->with === null) {
            throw new \LogicException('Ask with has not been set.');
        }

        return $this->with;
    }

    public function setWith(array $with): AskInterface
    {
        if ($this->with !== null) {
            throw new \LogicException('Ask with is already set.');
        }
        $this->with = $with;

        return $this;
    }

    public function hasWith(): bool
    {
        return $this->with !== null;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
