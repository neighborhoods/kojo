<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service\Create;

use Neighborhoods\Kojo\Type\Service\CreateInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoTypeServiceCreate;

    public function setTypeServiceCreate(CreateInterface $typeServiceCreate): self
    {
        if ($this->hasTypeServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoTypeServiceCreate is already set.');
        }
        $this->NeighborhoodsKojoTypeServiceCreate = $typeServiceCreate;

        return $this;
    }

    protected function getTypeServiceCreate(): CreateInterface
    {
        if (!$this->hasTypeServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoTypeServiceCreate is not set.');
        }

        return $this->NeighborhoodsKojoTypeServiceCreate;
    }

    protected function hasTypeServiceCreate(): bool
    {
        return isset($this->NeighborhoodsKojoTypeServiceCreate);
    }

    protected function unsetTypeServiceCreate(): self
    {
        if (!$this->hasTypeServiceCreate()) {
            throw new \LogicException('NeighborhoodsKojoTypeServiceCreate is not set.');
        }
        unset($this->NeighborhoodsKojoTypeServiceCreate);

        return $this;
    }
}
