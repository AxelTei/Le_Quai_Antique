<?php

namespace App\Repository;

use App\Entity\RestaurantRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RestaurantRule>
 *
 * @method RestaurantRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantRule[]    findAll()
 * @method RestaurantRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantRule::class);
    }

    public function save(RestaurantRule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RestaurantRule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLastRuleSubmitted(): ?RestaurantRule
   {
    return $this->createQueryBuilder('r')
        ->orderBy('r.id', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult()
    ;
    }
}
