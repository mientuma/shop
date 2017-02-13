<?php

namespace AppBundle\Utils;

use AppBundle\Entity\OrderedProducts;
use Doctrine\ORM\EntityManager;

class OrderedProductsManager
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getOrderedProducts($id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('o')
            ->from('AppBundle:OrderedProducts', 'o')
            ->where('o.orderId = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

}