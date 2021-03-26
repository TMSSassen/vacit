<?php

namespace App\Repository;

use App\Entity\Solicitatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Solicitatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Solicitatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Solicitatie[]    findAll()
 * @method Solicitatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitatie::class);
    }

    // /**
    //  * @return Solicitatie[] Returns an array of Solicitatie objects
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
    public function findOneBySomeField($value): ?Solicitatie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
