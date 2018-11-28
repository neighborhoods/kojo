<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

interface FilterInterface extends \JsonSerializable
{
    public function getField(): string;

    public function setField(string $field): FilterInterface;

    public function getValues(): array;

    public function setValues(array $values): FilterInterface;

    public function getConditionType(): string;

    public function setConditionType(string $condition): FilterInterface;
}
