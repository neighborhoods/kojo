<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Process\Signal\InformationInterface;

interface CollectionInterface extends \Iterator
{
    public function addInformation(InformationInterface $information): CollectionInterface;

    public function unsetInformation(int $position): CollectionInterface;

    public function current(): InformationInterface;

    public function next();

    public function key(): int;

    public function valid(): bool;

    public function rewind();
}