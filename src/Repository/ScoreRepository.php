<?php

namespace App\Repository;

use App\Entity\Score;
use App\Entity\User;
use App\Enum\ScoreType;
use App\Repository\Interfaces\ScoreRepositoryInterface;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Score>
 *
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends BaseRepository implements ScoreRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function store(User $user, ScoreType $type, int $value = 0): Score
    {
        return $this->createEntity([
            'user'       => $user,
            'type'       => $type->value,
            'value'      => $value,
            'created_at' => new DateTimeImmutable,
        ]);
    }

    public function updateValue(Score $score, int $value): Score
    {
        $score->setValue($value);

        return $this->storeEntity($score);
    }



    public function getScore(User $user, string $type, string $createdAt): Score|null
    {
        return $this->findOneBy([
            'user_id'    => $user->getId(),
            'type'       => $type,
            'created_at' => $createdAt,
        ]);
    }

    public function getScores(User $user, string $type = null): array
    {
        $criteria = ['user_id' => $user->getId()];
        if ($type) {
            $criteria['type'] = $type;
        }

        return $this->findBy($criteria);
    }

    public function createScore(User $user, string $type, int $value): Score
    {
        return $this->store(
            user: $user,
            type: ScoreType::make($type),
            value: $value,
        );
    }

//    /**
//     * @return Score[] Returns an array of Score objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Score
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
