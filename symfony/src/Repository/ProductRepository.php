<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    public function findByManyFilters(array $filters)
    {
        $index = 0;
        $query = $this->createQueryBuilder('p');
        foreach ($filters as $key => $filter) {
            if ($filter) {
                $index += 1;
                $query->andWhere('p.' . $key . ' = :val' . $index);
                $query->setParameter('val' . $index, $filter);
            }
        }
        return $query->getQuery()->getResult();
    }

    public function findDistinctBrand()
    {
        $query = $this->createQueryBuilder('b')
            ->select('b.brand')
            ->groupBy('b.brand')
            ->orderBy('b.brand', 'ASC');
        return $query->getQuery()->getResult();
    }

    public function findDistinctMaterial()
    {
        $query = $this->createQueryBuilder('m')
            ->select('m.material')
            ->groupBy('m.material')
            ->orderBy('m.material', 'ASC');
        return $query->getQuery()->getResult();
    }

    public function findDistinctCaseDiameter()
    {
        $query = $this->createQueryBuilder('cd')
            ->select('cd.case_diameter')
            ->groupBy('cd.case_diameter')
            ->orderBy('cd.case_diameter', 'ASC');
        return $query->getQuery()->getResult();
    }


    public function findBySearchTerms($search)
    {
        return $this->createQueryBuilder('p')
            ->where('p.brand LIKE :search')
            ->orWhere('p.model LIKE :search')
            ->setParameter(':search', '%' . $search . '%')
            ->getQuery()->getResult();
    }


   public function findDistinctMovement()
   {
        $query = $this->createQueryBuilder('mv')
                ->select('mv.movement')
                ->groupBy('mv.movement')
                ->orderBy('mv.movement','ASC');
        return $query->getQuery()->getResult();
   }

   public function findDistinctCategory()
   {
        $query = $this->createQueryBuilder('c')
                ->select('c.category')
                ->groupBy('c.category');
        return $query->getQuery()->getResult();
   }

    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
           ->getQuery()
            ->getOneOrNullResult()
        ;
   }

