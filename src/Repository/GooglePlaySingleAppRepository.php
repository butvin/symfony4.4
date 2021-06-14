<?php

namespace App\Repository;

use App\Entity\GooglePlaySingleApp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GooglePlaySingleApp|null find($id, $lockMode = null, $lockVersion = null)
 * @method GooglePlaySingleApp|null findOneBy(array $criteria, array $orderBy = null)
 * @method GooglePlaySingleApp[]    findAll()
 * @method GooglePlaySingleApp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GooglePlaySingleAppRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GooglePlaySingleApp::class);
    }

    // /**
    //  * @return GooglePlaySingleApp[] Returns an array of GooglePlaySingleApp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GooglePlaySingleApp
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
