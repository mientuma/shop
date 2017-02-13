<?php

namespace AppBundle\Utils;

use AppBundle\Entity\OrderedProducts;
use Doctrine\ORM\EntityManager;

class OrderedProductsManager
{
    protected $em;
    protected $product;

    public function __construct(EntityManager $entityManager, OrderedProducts $orderedProducts)
    {
        $this->product = $orderedProducts;
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

    public function countFinalPrice($orderedProducts)
    {
        foreach($orderedProducts as $orderedProduct)
        {
            $this->product = $orderedProduct;
            $this->product->setFinalPrice();
        }

        return $orderedProducts;
    }

    public function countSum($deliveryPrice, $orderDetails)
    {
        $sum = $deliveryPrice;

        foreach ($orderDetails as $orderRow)
        {
            $this->product = $orderRow;
            $sum += $this->product->getFinalPrice();
        }

        return $sum;
    }


}