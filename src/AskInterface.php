<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface AskInterface extends \JsonSerializable
{
    public function getWhere(): WhereInterface;

    public function setWhere(WhereInterface $search_criteria): AskInterface;

    public function hasWhere(): bool;

    public function getUse(): array;

    public function setUse(array $use): AskInterface;

    public function hasUse(): bool;

    public function getWith(): \Object;

    public function setWith(\Object $with): AskInterface;

    public function hasWith(): bool;
}
