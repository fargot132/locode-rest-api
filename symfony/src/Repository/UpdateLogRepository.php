<?php

namespace App\Repository;

use App\Entity\UpdateLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UpdateLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateLog[]    findAll()
 * @method UpdateLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdateLog::class);
    }

    // /**
    //  * @return UpdateLog[] Returns an array of UpdateLog objects
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
    public function findOneBySomeField($value): ?UpdateLog
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function getLastUpdate()
    {
        return $this->createQueryBuilder('log')
            ->andWhere('log.updated = :updated')
            ->setParameter('updated', 1)
            ->orderBy('log.date', 'desc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
