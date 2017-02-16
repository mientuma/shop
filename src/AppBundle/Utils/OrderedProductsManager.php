<?php

namespace AppBundle\Utils;

use AppBundle\Entity\OrderedProducts;
use Doctrine\ORM\EntityManager;

class OrderedProductsManager
{
    protected $product;
    protected $em;

    public function __construct(OrderedProducts $orderedProducts, EntityManager $entityManager)
    {
        $this->product = $orderedProducts;
        $this->em = $entityManager;
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

    public function manageOrderedProductsReservation($orderedProducts)
    {
        foreach ($orderedProducts as $orderedProduct)
        {
            $this->product = $orderedProduct;
            $product = $this->product->getProduct();
            $quantity = $this->product->getProductQuantity();
            $reservation = $this->product->getProductReserved();
            $difference = $quantity - $reservation;
            $databaseQuantity = $this->getProductQuantity($product);

            if($databaseQuantity >= $difference)
            {
                $newProductValue = $databaseQuantity-$difference;
                $product->setQuantity($newProductValue);

                $this->product->setProductReserved($quantity);
                $this->product->setProductStatus('Towar zarezerwowany');
                $this->em->persist($product);
                $this->em->persist($this->product);
                $this->em->flush();
            }
            elseif($databaseQuantity == 0)
            {
                break 1;
            }
            else
            {
                $newReservation = $reservation + $databaseQuantity;
                $this->product->setProductReserved($newReservation);
                $this->product->setProductStatus('Towar częściowo zarezerwowany');
                $product->setQuantity(0);
                $this->em->persist($this->product);
                $this->em->persist($product);
                $this->em->flush();
            }
        }
    }

    public function getProductQuantity($product)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('p.quantity')
            ->from('AppBundle:Products', 'p')
            ->where('p = :product')
            ->setParameter('p', $product);

        return $qb->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }


}