<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface DecoratorInterface extends HandlerInterface
{
    public function setProcessSignalHandler(HandlerInterface $processSignalHandler);

    public function setIsBuffered(bool $IsBuffered): DecoratorInterface;

    public function isBuffered(): bool;
}
