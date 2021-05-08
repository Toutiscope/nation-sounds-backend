<?php

namespace App\Repository;

use App\Entity\Wc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wc[]    findAll()
 * @method Wc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wc::class);
    }

    // /**
    //  * @return Wc[] Returns an array of Wc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wc
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
