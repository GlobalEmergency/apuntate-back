<?php

namespace GlobalEmergency\Apuntate\Repository;

use GlobalEmergency\Apuntate\Entity\UnitComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitComponent[]    findAll()
 * @method UnitComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitComponent::class);
    }

    // /**
    //  * @return UnitComponent[] Returns an array of UnitComponent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnitComponent
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
