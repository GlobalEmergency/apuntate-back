<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function findBetweenDates(\DateTime $dateStart, \DateTime $dateEnd){
        return $this->createQueryBuilder('s')
            ->andWhere('s.date BETWEEN :start AND :end')
            ->setParameter('start', $dateStart->format('Y-m-d H:i'))
            ->setParameter('end', $dateEnd->format('Y-m-d H:i'))
            ->orderBy('s.date', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;

    }

    // /**
    //  * @return Service[] Returns an array of Service objects
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
    public function findOneBySomeField($value): ?Service
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findNexts(\DateTime $date = null)
    {
        if(is_null($date)){
            $date = new \DateTime();
        }
        return $this->createQueryBuilder('s')
            ->andWhere('s.date > :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
            ;

    }

    public function save(Service $service)
    {
        $this->_em->persist($service);
        $this->_em->flush($service);
    }
}
