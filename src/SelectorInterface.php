<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface SelectorInterface
{
    public function getWorkableJob(): JobInterface;

    public function hasWorkableJob(): bool;

    public function setPageSize(int $pageSize): SelectorInterface;

    public function setOffset(int $offset): SelectorInterface;

    public function setRandomIntMax(int $randomIntMax): SelectorInterface;

    public function setProcess(ProcessInterface $process);
}