<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success\Factory;

use Neighborhoods\Kojo\Service\Update\Complete\Success\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteSuccessFactory;

    public function setServiceUpdateCompleteSuccessFactory(FactoryInterface $serviceUpdateCompleteSuccessFactory): self
    {
        if ($this->hasServiceUpdateCompleteSuccessFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccessFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteSuccessFactory = $serviceUpdateCompleteSuccessFactory;

        return $this;
    }

    protected function getServiceUpdateCompleteSuccessFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateCompleteSuccessFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccessFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteSuccessFactory;
    }

    protected function hasServiceUpdateCompleteSuccessFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteSuccessFactory);
    }

    protected function unsetServiceUpdateCompleteSuccessFactory(): self
    {
        if (!$this->hasServiceUpdateCompleteSuccessFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccessFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteSuccessFactory);

        return $this;
    }
}
