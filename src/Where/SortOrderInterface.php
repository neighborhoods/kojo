<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

interface SortOrderInterface extends \JsonSerializable
{
    public function getField(): string;

    public function setField(string $field): SortOrderInterface;

    public function getDirection(): string;

    public function setDirection(string $direction): SortOrderInterface;

    public function hasField(): bool;

    public function hasDirection(): bool;
}
