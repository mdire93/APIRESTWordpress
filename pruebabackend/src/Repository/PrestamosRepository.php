<?php

namespace App\Repository;

use App\Entity\Prestamos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestamos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestamos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestamos[]    findAll()
 * @method Prestamos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestamosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestamos::class);
    }

    // /**
    //  * @return Prestamos[] Returns an array of Prestamos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prestamos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
