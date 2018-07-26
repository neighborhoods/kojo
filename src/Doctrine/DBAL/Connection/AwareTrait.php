<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection;

use Doctrine\DBAL\Connection;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $DoctrineDBALConnection;

    public function setDoctrineDBALConnection(Connection $doctrineDBALConnection): self
    {
        if ($this->hasDoctrineDBALConnection()) {
            throw new \LogicException('DoctrineDBALConnection is already set.');
        }
        $this->DoctrineDBALConnection = $doctrineDBALConnection;

        return $this;
    }

    protected function getDoctrineDBALConnection(): Connection
    {
        if (!$this->hasDoctrineDBALConnection()) {
            throw new \LogicException('DoctrineDBALConnection is not set.');
        }

        return $this->DoctrineDBALConnection;
    }

    protected function hasDoctrineDBALConnection(): bool
    {
        return isset($this->DoctrineDBALConnection);
    }

    protected function unsetDoctrineDBALConnection(): self
    {
        if (!$this->hasDoctrineDBALConnection()) {
            throw new \LogicException('DoctrineDBALConnection is not set.');
        }
        unset($this->DoctrineDBALConnection);

        return $this;
    }
}
