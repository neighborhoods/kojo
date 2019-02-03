<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface ErrorHandlerInterface
{
    public function __invoke(
        int $errorNumber,
        string $errorString,
        string $errorFile,
        int $errorLine
    );
}
