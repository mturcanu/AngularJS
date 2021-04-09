<?php

namespace App\Repository;

use App\Entity\LucrariEfectuate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LucrariEfectuate|null find($id, $lockMode = null, $lockVersion = null)
 * @method LucrariEfectuate|null findOneBy(array $criteria, array $orderBy = null)
 * @method LucrariEfectuate[]    findAll()
 * @method LucrariEfectuate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LucrariEfectuateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LucrariEfectuate::class);
    }

    // /**
    //  * @return LucrariEfectuate[] Returns an array of LucrariEfectuate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LucrariEfectuate
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
