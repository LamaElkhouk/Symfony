<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * Retourne 3 produits au hasard
     *
     * @return void
     */
    public function getRandomProduct()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('RAND()')
            ->setMaxResults(3)
            ->getQuery();
    }

    /**
     * Retourne le nombre de produit
     *
     */
    public function nbProduct(): Query
    {
        return $this->createQueryBuilder('p')
            ->select('count(p)')
            ->getQuery();
    }

    //pagination(numero de la page ou je me trouve, nombre de resultats à afficher par page)
    public function pagination($page, $limit)
    {
        // $count = $this->createQueryBuilder('p')
        //     ->select('count(p)')
        //     ->getQuery()
        //     ->getSingleScalarResult();

        $nbPage = ceil($this->nbProduct()->getSingleScalarResult() / $limit);  //ceil(4.3)= 5 arrondi à l'entier superieur

        $query = $this->createQueryBuilder('p')
            ->setMaxResults($limit)
            ->setFirstResult(($page * $limit) - $limit)
            ->getQuery()
            ->getResult();

        $resultat = [];

        $resultat['nb_pages'] = $nbPage;
        $resultat['limit'] = $limit;
        $resultat['page'] = $page;
        $resultat['query'] = $query;

        return $resultat;
    }


    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}