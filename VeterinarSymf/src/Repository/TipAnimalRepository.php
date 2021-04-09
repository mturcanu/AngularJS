<?php

namespace App\Repository;

use App\Entity\TipAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipAnimal[]    findAll()
 * @method TipAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipAnimal::class);
    }

    // /**
    //  * @return TipAnimal[] Returns an array of TipAnimal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipAnimal
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
