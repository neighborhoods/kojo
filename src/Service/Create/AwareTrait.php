<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create;

use Neighborhoods\Kojo\Service\CreateInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceCreate;

    public function setServiceCreate(CreateInterface $serviceCreate): self
    {
        if ($this->hasServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreate is already set.');
        }
        $this->NeighborhoodsKojoServiceCreate = $serviceCreate;

        return $this;
    }

    protected function getServiceCreate(): CreateInterface
    {
        if (!$this->hasServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreate is not set.');
        }

        return $this->NeighborhoodsKojoServiceCreate;
    }

    protected function hasServiceCreate(): bool
    {
        return isset($this->NeighborhoodsKojoServiceCreate);
    }

    protected function unsetServiceCreate(): self
    {
        if (!$this->hasServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoServiceCreate is not set.');
        }
        unset($this->NeighborhoodsKojoServiceCreate);

        return $this;
    }
}
