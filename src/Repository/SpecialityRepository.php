<?php

namespace App\Repository;

use App\Entity\Speciality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Speciality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Speciality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Speciality[]    findAll()
 * @method Speciality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    // /**
    //  * @return Speciality[] Returns an array of Speciality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Speciality
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
