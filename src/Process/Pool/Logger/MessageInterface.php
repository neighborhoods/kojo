<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;


use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface;

interface MessageInterface
{
    public function getTime(): string;

    public function getLevel(): string;

    public function getProcessId(): string;

    public function getProcessPath(): string;

    public function getMessage(): string;

    public function getContext(): array;

    public function getContextJsonLastError(): int;

    public function getKojoJob() : JobInterface;

    public function hasKojoJob() : bool;

    public function hasKojoProcess() : bool;

    public function getKojoProcess() : ProcessInterface;

}
