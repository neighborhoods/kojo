<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface AskInterface extends \JsonSerializable
{
    public function getWhere(): WhereInterface;

    public function setWhere(WhereInterface $where): AskInterface;

    public function hasWhere(): bool;

    public function getFactoryFQCN(): string;

    public function setFactoryFQCN(string $factory_fqcn): AskInterface;

    public function hasFactoryFQCN(): bool;

    public function getBuilderFQCN(): string;

    public function setBuilderFQCN(string $builder_fqcn): AskInterface;

    public function hasBuilderFQCN(): bool;

    public function getWith(): array;

    public function setWith(array $with): AskInterface;

    public function hasWith(): bool;
}
