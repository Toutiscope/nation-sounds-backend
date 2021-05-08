<?php

namespace App\Repository;

use App\Entity\MusicStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MusicStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method MusicStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method MusicStyle[]    findAll()
 * @method MusicStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicStyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MusicStyle::class);
    }

    // /**
    //  * @return MusicStyle[] Returns an array of MusicStyle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MusicStyle
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
