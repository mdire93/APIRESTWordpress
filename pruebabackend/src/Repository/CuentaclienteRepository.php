<?php

namespace App\Repository;

use App\Entity\Cuentacliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cuentacliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuentacliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuentacliente[]    findAll()
 * @method Cuentacliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuentaclienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuentacliente::class);
    }

    // /**
    //  * @return Cuentacliente[] Returns an array of Cuentacliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cuentacliente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
