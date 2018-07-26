<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $SymfonyComponentFilesystemFilesystem;

    public function setSymfonyComponentFilesystemFilesystem(Filesystem $symfonyComponentFilesystemFilesystem
    ): self {
        if ($this->hasSymfonyComponentFilesystemFilesystem()) {
            throw new \LogicException('SymfonyComponentFilesystemFilesystem is already set.');
        }
        $this->SymfonyComponentFilesystemFilesystem = $symfonyComponentFilesystemFilesystem;

        return $this;
    }

    protected function getSymfonyComponentFilesystemFilesystem(): Filesystem
    {
        if (!$this->hasSymfonyComponentFilesystemFilesystem()) {
            throw new \LogicException('SymfonyComponentFilesystemFilesystem is not set.');
        }

        return $this->SymfonyComponentFilesystemFilesystem;
    }

    protected function hasSymfonyComponentFilesystemFilesystem(): bool
    {
        return isset($this->SymfonyComponentFilesystemFilesystem);
    }

    protected function unsetSymfonyComponentFilesystemFilesystem(): self
    {
        if (!$this->hasSymfonyComponentFilesystemFilesystem()) {
            throw new \LogicException('SymfonyComponentFilesystemFilesystem is not set.');
        }
        unset($this->SymfonyComponentFilesystemFilesystem);

        return $this;
    }
}
