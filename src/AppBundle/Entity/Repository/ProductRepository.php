<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param $type
     * @return \Doctrine\ORM\Query
     */
    public function findAllProducts($type)
    {
        return  $this->getEntityManager()
            ->createQuery("SELECT p, i
                           FROM AppBundle:Product p
                           LEFT JOIN p.productImage i
                           WHERE :type IS NULL OR p.type = :type")
            ->setParameter('type', $type);
    }

    /**
     * @param $first
     * @param $count
     * @param $types
     * @param $flowers
     * @param $colors
     * @return array
     */
    public function findAllByFilters($first, $count, $types = null, $flowers = null, $colors = null)
    {
        $idQuery = $this->getEntityManager()
            ->createQueryBuilder()
            ->select("DISTINCT p.id")
            ->from("AppBundle:Product", "p")
//            ->join('p.flowers', 'f')
//            ->where('NOT EXISTS (SELECT f1.id FROM AppBundle:Product p1 LEFT JOIN p1.flowers f1 WHERE f1.isExists = false AND p1.id = p.id)')
            ->setFirstResult($first)
            ->setMaxResults($count)
        ;

        if (!is_null($types) && count($types) != 0){
            $idQuery
                ->andWhere('p.type IN (:types)')
                ->setParameter('types', $types);
        }

        if (!is_null($flowers) && count($flowers) != 0){

            $flowerIds = array_column($flowers, 'id');

            $idQuery
                ->andWhere('f.id IN (:flowerIds)')
                ->setParameter('flowerIds', $flowerIds);
        }

        if (!is_null($colors) && count($colors) != 0){

            $colorIds = array_column($colors, 'id');

            $idQuery
                ->join('p.colors', 'c')
                ->andWhere('c.id IN (:colorIds)')
                ->setParameter('colorIds', $colorIds);
        }

        $ids = $idQuery->getQuery()->getResult();

        if (count($ids) == 0){
            return [];
        }

        return $this->getEntityManager()
            ->createQuery("SELECT p, i
                           FROM AppBundle:Product p
                           JOIN p.productImage i
                           WHERE p.id IN (:ids)")
            ->setParameter('ids', $ids)
            ->getResult();
    }
}
