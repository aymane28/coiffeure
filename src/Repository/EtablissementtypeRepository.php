<?php

namespace App\Repository;

use App\Entity\Etablissementtype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etablissementtype>
 *
 * @method Etablissementtype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etablissementtype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etablissementtype[]    findAll()
 * @method Etablissementtype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtablissementtypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etablissementtype::class);
    }

    public function add(Etablissementtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Etablissementtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

       /**
         * @return Etablissementtype[] Returns an array of Etablissementtype objects
        */
        public function findByExampleField($value): array
        {
            return $this->createQueryBuilder('e')
                ->andWhere('e.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('e.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }

//    public function findOneBySomeField($value): ?Etablissementtype
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
