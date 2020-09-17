<?php

namespace App\Repository;

use App\Entity\LocationProd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationProdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocationProd::class);
    }

    public function searchByName(string $name)
    {
        return $this->createQueryBuilder('location')
            ->andWhere('location.nameWoDiacritics like :name')
            ->setParameter('name', '%' . addcslashes($name, '%_') . '%')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findOneByLocode(string $value): ?LocationProd
    {
        $value = str_replace(["\n","\r"," "], '', $value);
        $countryCode = substr($value, 0, 2);
        $locationCode = substr($value, 2, 3);
        
        return $this->createQueryBuilder('location')
            ->andWhere('location.code = :locationCode')
            ->setParameter('locationCode', $locationCode)
            ->join('location.country', 'country')
            ->andWhere('country.code = :countryCode')
            ->setParameter('countryCode', $countryCode)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
