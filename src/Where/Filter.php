<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

class Filter implements FilterInterface
{
    protected $field;
    protected $value;
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

    public function hasField(): bool
    {
        return $this->field !== null;
    }

    public function getValue()
    {
        if ($this->value === null) {
            throw new \LogicException('Filter value has not been set.');
        }

        return $this->value;
    }

    public function setValue($values): FilterInterface
    {
        if ($this->value !== null) {
            throw new \LogicException('Filter value is already set.');
        }
        $this->value = $values;

        return $this;
    }

    public function hasValue(): bool
    {
        return $this->value !== null;
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

    public function hasConditionType(): bool
    {
        return $this->condition_type !== null;
    }
}
