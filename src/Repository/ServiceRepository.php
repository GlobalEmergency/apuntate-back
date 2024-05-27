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

    /**
     * @return Service[] Returns an array of Service objects
     */
    public function findBetweenDates(\DateTime $dateStart, \DateTime $dateEnd): array
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

    public function findNexts(?\DateTime $date = null)
    {
        if (is_null($date)) {
            $date = Carbon::now();
        } elseif ($date instanceof \DateTime) {
            $date = Carbon::instance($date);
        }

        return $this->createQueryBuilder('s')
            ->andWhere('s.dateStart > :date')
            ->setParameter('date', $date)
            ->orderBy('s.dateStart', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function save(Service $service): void
    {
        $this->getEntityManager()->persist($service);
        $this->getEntityManager()->flush();
    }
}
