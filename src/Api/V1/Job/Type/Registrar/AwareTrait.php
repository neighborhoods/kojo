<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type\Registrar;

use Neighborhoods\Kojo\Api\V1\Job\Type\RegistrarInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1JobTypeRegistrar;

    public function setApiV1JobTypeRegistrar(RegistrarInterface $apiV1JobTypeRegistrar): self
    {
        assert(!$this->hasApiV1JobTypeRegistrar(),
            new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrar is already set.'));
        $this->NeighborhoodsKojoApiV1JobTypeRegistrar = $apiV1JobTypeRegistrar;

        return $this;
    }

    protected function getApiV1JobTypeRegistrar(): RegistrarInterface
    {
        assert($this->hasApiV1JobTypeRegistrar(),
            new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrar is not set.'));

        return $this->NeighborhoodsKojoApiV1JobTypeRegistrar;
    }

    protected function hasApiV1JobTypeRegistrar(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1JobTypeRegistrar);
    }

    protected function unsetApiV1JobTypeRegistrar(): self
    {
        assert($this->hasApiV1JobTypeRegistrar(),
            new \LogicException('NeighborhoodsKojoApiV1JobTypeRegistrar is not set.'));
        unset($this->NeighborhoodsKojoApiV1JobTypeRegistrar);

        return $this;
    }
}
