<?php

namespace App\Repository;

use App\Entity\BonEntrant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BonEntrant|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonEntrant|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonEntrant[]    findAll()
 * @method BonEntrant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonEntrantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonEntrant::class);
    }

    // /**
    //  * @return BonEntrant[] Returns an array of BonEntrant objects
    //  */
    
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
     * @return BonEntrant[]
     */
    public function findAllByAPack($value): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Entity\BonEntrant b
            WHERE b.pack = :pack
            ORDER BY b.id ASC'
        )->setParameter('pack', $value);
    return $query->getResult();
    }

    /**
     * @return BonEntrant[]
     */
    public function findCountMonth($years): array
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total,  MONTH(b.created_at) as mois FROM bon_entrant b 
         WHERE YEAR(b.created_at)='.$years.'
         GROUP BY MONTH(b.created_at)
         ORDER BY MONTH(b.created_at) ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function findCountDay($years): array
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total, DATE(b.created_at) as date FROM bon_entrant b 
         WHERE YEAR(b.created_at)='.$years.'
         GROUP BY DATE(b.created_at)
         ORDER BY b.created_at ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function findCountFournisseur(): array
    {

        $conn = $this->getEntityManager()->getConnection();
         $sql='
         SELECT count(*) as total, f.nom FROM bon_entrant b ,fournisseur f
         WHERE  f.id =b.fournisseur_id
         GROUP BY f.id
         ORDER BY f.id ASC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    /*
    public function findOneBySomeField($value): ?BonEntrant
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
