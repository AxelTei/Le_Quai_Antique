<?php

namespace App\Repository;

use App\Entity\RestaurantPlaces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RestaurantPlaces>
 *
 * @method RestaurantPlaces|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantPlaces|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantPlaces[]    findAll()
 * @method RestaurantPlaces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantPlacesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantPlaces::class);
    }

    public function save(RestaurantPlaces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RestaurantPlaces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function findLastDateSubmit(): ?RestaurantPlaces
   {
       return $this->createQueryBuilder('r')
           ->orderBy('r.id', 'DESC')
           ->setMaxResults(1)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
