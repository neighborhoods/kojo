<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

class SortOrder implements SortOrderInterface
{
    protected $field;
    protected $direction;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getField(): string
    {
        if ($this->field === null) {
            throw new \LogicException('SortOrder field has not been set.');
        }

        return $this->field;
    }

    public function setField(string $field): SortOrderInterface
    {
        if ($this->field !== null) {
            throw new \LogicException('SortOrder field is already set.');
        }
        $this->field = $field;

        return $this;
    }

    public function getDirection(): string
    {
        if ($this->direction === null) {
            throw new \LogicException('SortOrder direction has not been set.');
        }

        return $this->direction;
    }

    public function setDirection(string $direction): SortOrderInterface
    {
        if ($this->direction !== null) {
            throw new \LogicException('SortOrder direction is already set.');
        }
        $this->direction = $direction;

        return $this;
    }
}
