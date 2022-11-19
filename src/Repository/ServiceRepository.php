<?php

namespace GlobalEmergency\Apuntate\Repository;

use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use GlobalEmergency\Apuntate\Entity\Service;

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

    public function findBetweenDates(\DateTime $dateStart, \DateTime $dateEnd)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.dateStart BETWEEN :start AND :end')
            ->setParameter('start', $dateStart->format('Y-m-d H:i'))
            ->setParameter('end', $dateEnd->format('Y-m-d H:i'))
            ->orderBy('s.dateStart', 'ASC')
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
    public function findNexts(\DateTime $date = null, bool $prev = false)
    {
        if (is_null($date)) {
            $date = Carbon::now();
        } elseif ($date instanceof \DateTime) {
            $date = Carbon::instance($date);
        }

        if ($prev) {
            $date->subDays(15);
        }

        return $this->createQueryBuilder('s')
            ->andWhere('s.dateStart > :date')
            ->setParameter('date', $date)
            ->orderBy('s.dateStart', 'ASC')
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
