<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Guzzle\Service\Resource\Model;

use Guzzle\Service\Resource\Model;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1GuzzleServiceResourceModel;

    public function setV1GuzzleServiceResourceModel(Model $v1GuzzleServiceResourceModel): self
    {
        assert(!$this->hasV1GuzzleServiceResourceModel(),
            new \LogicException('NeighborhoodsKojoExampleV1GuzzleServiceResourceModel is already set.'));
        $this->NeighborhoodsKojoExampleV1GuzzleServiceResourceModel = $v1GuzzleServiceResourceModel;

        return $this;
    }

    protected function getV1GuzzleServiceResourceModel(): Model
    {
        assert($this->hasV1GuzzleServiceResourceModel(),
            new \LogicException('NeighborhoodsKojoExampleV1GuzzleServiceResourceModel is not set.'));

        return $this->NeighborhoodsKojoExampleV1GuzzleServiceResourceModel;
    }

    protected function hasV1GuzzleServiceResourceModel(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1GuzzleServiceResourceModel);
    }

    protected function unsetV1GuzzleServiceResourceModel(): self
    {
        assert($this->hasV1GuzzleServiceResourceModel(),
            new \LogicException('NeighborhoodsKojoExampleV1GuzzleServiceResourceModel is not set.'));
        unset($this->NeighborhoodsKojoExampleV1GuzzleServiceResourceModel);

        return $this;
    }
}
