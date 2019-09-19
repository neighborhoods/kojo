<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\Doctrine;
use Doctrine\DBAL\Connection;
use Neighborhoods\Kojo\StateTransitionChangeInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Repository implements RepositoryInterface
{
    use Defensive\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;
    use Map\Builder\Factory\AwareTrait;

    protected const JSON_COLUMNS = [
        StateTransitionChangeInterface::PROP_DATA
    ];

    /** @var Connection */
    protected $doctrineConnection;

    public function selectBatch(int $batchSize) : MapInterface
    {
        $queryBuilder = $this->getDoctrineConnection()->createQueryBuilder();

        $queryBuilder
            ->from(self::TABLE_NAME)
            ->select('*')
            ->setMaxResults($batchSize)
            ->setFirstResult(0);

        $records = $queryBuilder->execute()->fetchAll();

        foreach ($records as $key => $record) {
            foreach (self::JSON_COLUMNS as $jsonColumn) {
                $records[$key][$jsonColumn] = json_decode($records[$key][$jsonColumn], true);
            }
        }

        return $this
            ->getStateTransitionChangeMapBuilderFactory()
            ->create()
            ->setRecords($records)
            ->build();
    }

    public function deleteBatch(int ...$ids) : RepositoryInterface
    {
        $queryBuilder = $this->getDoctrineConnection()->createQueryBuilder();

        $queryBuilder
            ->delete(self::TABLE_NAME)
            ->where(
                $queryBuilder->expr()->in(StateTransitionChangeInterface::PROP_ID, $ids)
            );

        $queryBuilder->execute();

        return $this;
    }

    public function getDoctrineConnection() : Connection
    {
        if ($this->doctrineConnection === null) {
            $this->doctrineConnection = $this
                ->_getDoctrineConnectionDecoratorRepository()
                ->getConnection(Doctrine\Connection\DecoratorInterface::ID_STATE_TRANSITION_CHANGE);
        }
        return $this->doctrineConnection;
    }
}
