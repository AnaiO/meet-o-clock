<?php

namespace App\Repository;

use App\Entity\UserEventParticipation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserEventParticipation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEventParticipation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEventParticipation[]    findAll()
 * @method UserEventParticipation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEventParticipationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEventParticipation::class);
    }

    // /**
    //  * @return UserEventParticipation[] Returns an array of UserEventParticipation objects
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
    public function findOneBySomeField($value): ?UserEventParticipation
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
