<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Aws\Sqs\SqsClient;

use Aws\Sqs\SqsClient;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1AwsSqsSqsClient;

    public function setV1AwsSqsSqsClient(SqsClient $v1AwsSqsSqsClient): self
    {
        assert(!$this->hasV1AwsSqsSqsClient(),
            new \LogicException('NeighborhoodsKojoExampleV1AwsSqsSqsClient is already set.'));
        $this->NeighborhoodsKojoExampleV1AwsSqsSqsClient = $v1AwsSqsSqsClient;

        return $this;
    }

    protected function getV1AwsSqsSqsClient(): SqsClient
    {
        assert($this->hasV1AwsSqsSqsClient(),
            new \LogicException('NeighborhoodsKojoExampleV1AwsSqsSqsClient is not set.'));

        return $this->NeighborhoodsKojoExampleV1AwsSqsSqsClient;
    }

    protected function hasV1AwsSqsSqsClient(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1AwsSqsSqsClient);
    }

    protected function unsetV1AwsSqsSqsClient(): self
    {
        assert($this->hasV1AwsSqsSqsClient(),
            new \LogicException('NeighborhoodsKojoExampleV1AwsSqsSqsClient is not set.'));
        unset($this->NeighborhoodsKojoExampleV1AwsSqsSqsClient);

        return $this;
    }
}
