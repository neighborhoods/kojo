<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Type\Registrar\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1JobTypeRegistrarFactory;

    public function setApiV1JobTypeRegistrarFactory(FactoryInterface $apiV1JobTypeRegistrarFactory): self
    {
        if ($this->hasApiV1JobTypeRegistrarFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrarFactory is already set.');
        }
        $this->NeighborhoodsKojoApiV1JobTypeRegistrarFactory = $apiV1JobTypeRegistrarFactory;

        return $this;
    }

    protected function getApiV1JobTypeRegistrarFactory(): FactoryInterface
    {
        if (!$this->hasApiV1JobTypeRegistrarFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrarFactory is not set.');
        }

        return $this->NeighborhoodsKojoApiV1JobTypeRegistrarFactory;
    }

    protected function hasApiV1JobTypeRegistrarFactory(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1JobTypeRegistrarFactory);
    }

    protected function unsetApiV1JobTypeRegistrarFactory(): self
    {
        if (!$this->hasApiV1JobTypeRegistrarFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrarFactory is not set.');
        }
        unset($this->NeighborhoodsKojoApiV1JobTypeRegistrarFactory);

        return $this;
    }
}
