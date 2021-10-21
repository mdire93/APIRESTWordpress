<?php

namespace App\Repository;

use App\Entity\Prestamocliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestamocliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestamocliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestamocliente[]    findAll()
 * @method Prestamocliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestamoclienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestamocliente::class);
    }

    // /**
    //  * @return Prestamocliente[] Returns an array of Prestamocliente objects
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
    public function findOneBySomeField($value): ?Prestamocliente
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
