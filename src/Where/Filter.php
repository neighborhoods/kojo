<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

class Filter implements FilterInterface
{
    protected $field;
    protected $values;
    protected $condition_type;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getField(): string
    {
        if ($this->field === null) {
            throw new \LogicException('Filter field has not been set.');
        }

        return $this->field;
    }

    public function setField(string $field): FilterInterface
    {
        if ($this->field !== null) {
            throw new \LogicException('Filter field is already set.');
        }
        $this->field = $field;

        return $this;
    }

    public function getValue()
    {
        if ($this->values === null) {
            throw new \LogicException('Filter values has not been set.');
        }

        return $this->values;
    }

    public function setValue($values): FilterInterface
    {
        if ($this->values !== null) {
            throw new \LogicException('Filter values is already set.');
        }
        $this->values = $values;

        return $this;
    }

    public function getConditionType(): string
    {
        if ($this->condition_type === null) {
            throw new \LogicException('Filter condition_type has not been set.');
        }

        return $this->condition_type;
    }

    public function setConditionType(string $condition): FilterInterface
    {
        if ($this->condition_type !== null) {
            throw new \LogicException('Filter condition_type is already set.');
        }
        $this->condition_type = $condition;

        return $this;
    }
}
