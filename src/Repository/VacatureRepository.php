<?php

namespace App\Repository;

use App\Entity\Vacature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @method Vacature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacature[]    findAll()
 * @method Vacature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacature::class);
    }
    public function getAll(){
        return $this->findAll();
    }
    
    public function getMostRecent($maxResults=3){
        return $this->findBy([],['datum'=>'ASC'],$maxResults);
    }
    /**
     *  @return Vacature[] Returns an array of Vacature objects
     */    
    public function findAllOfBedrijf(User $user)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.bedrijf = :user_id')
            ->setParameter('user_id', $user->getID())
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Vacature[] Returns an array of Vacature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vacature
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
