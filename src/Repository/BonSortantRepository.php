<?php

namespace App\Repository;

use App\Entity\BonSortant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BonSortant|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonSortant|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonSortant[]    findAll()
 * @method BonSortant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonSortantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonSortant::class);
    }

    // /**
    //  * @return BonSortant[] Returns an array of BonSortant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findByPack()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.pack', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return BonSortant[]
     */
    public function findAllByAPack($value): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Entity\BonSortant b
            WHERE b.pack = :pack
            ORDER BY b.id ASC'
        )->setParameter('pack', $value);
        return $query->getResult();
    }

    /**
     * @return BonSortant[]
     */
    public function findCountMonth($years): array
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total,  MONTH(b.created_at) as mois FROM bon_sortant b 
         WHERE YEAR(b.created_at)='.$years.'
         GROUP BY MONTH(b.created_at)
         ORDER BY MONTH(b.created_at) ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    /**
     * @return BonSortant[]
     */
    public function findCountDay($years): array
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total, DATE(b.created_at) as date FROM bon_sortant b 
         WHERE YEAR(b.created_at)='.$years.'
         GROUP BY DATE(b.created_at)
         ORDER BY b.created_at ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function findCountPersonnel(): array
    {

        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total, p.nom FROM bon_sortant b ,personnel p
         WHERE  p.id =b.personnel_id
         GROUP BY p.id
         ORDER BY p.id ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }
    /*
    public function findOneBySomeField($value): ?BonSortant
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
