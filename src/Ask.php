<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class Ask implements AskInterface
{
    protected $search_criteria;
    protected $use;
    protected $with;

    public function getWhere(): WhereInterface
    {
        if ($this->search_criteria === null) {
            throw new \LogicException('Ask search_criteria has not been set.');
        }

        return $this->search_criteria;
    }

    public function setWhere(WhereInterface $search_criteria): AskInterface
    {
        if ($this->search_criteria !== null) {
            throw new \LogicException('Ask search_criteria is already set.');
        }
        $this->search_criteria = $search_criteria;

        return $this;
    }

    public function hasWhere(): bool
    {
        return $this->search_criteria !== null;
    }

    public function getUse(): array
    {
        if ($this->use === null) {
            throw new \LogicException('Ask use has not been set.');
        }

        return $this->use;
    }

    public function setUse(array $use): AskInterface
    {
        if ($this->use !== null) {
            throw new \LogicException('Ask use is already set.');
        }
        $this->use = $use;

        return $this;
    }

    public function hasUse(): bool
    {
        return $this->use !== null;
    }

    public function getWith(): \Object
    {
        if ($this->with === null) {
            throw new \LogicException('Ask with has not been set.');
        }

        return $this->with;
    }

    public function setWith(\Object $with): AskInterface
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
