<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    // /**
    //  * @return Vehicle[] Returns an array of Vehicle objects
    //  */
    public function findProducer()
    {
        return $this->createQueryBuilder('v')
            ->select('v.producer')
            ->groupBy('v.producer')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findModel($model)
    {

        return $this->createQueryBuilder('v')
            ->select('v.model')
            ->where('v.producer = :producer')
            ->setParameter('producer', $model['producer'])
            ->groupBy('v.model')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findYear($json)
    {
        $where = "";
        foreach($json as $x => $value) {
            $where .= "->andWhere('v.$x = :$value')";
        }

        $where = substr($where,1);

        return $this->createQueryBuilder('v')
            ->andWhere('v.producer = :producer')->setParameter('producer',$json['producer'])
            ->andWhere('v.model = :model')->setParameter('model',$json['model'])
            ->getQuery()
            ->getResult()
        ;
    }

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
    public function findOneBySomeField($value): ?Vehicle
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
