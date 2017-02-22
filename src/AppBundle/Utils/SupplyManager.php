<?php

namespace AppBundle\Utils;


use AppBundle\Entity\SupplyProducts;
use Doctrine\ORM\EntityManager;

class SupplyManager
{
    protected $supply;
    protected $em;

    public function __construct(SupplyProducts $supplyProducts, EntityManager $entityManager)
    {
        $this->supply = $supplyProducts;
        $this->em = $entityManager;
    }

    public function addProducts($supplies)
    {
        foreach ($supplies as $supply)
        {
            $this->supply = $supply;
            $addedQuantity = $this->supply->getProductQuantity();

            $product = $this->supply->getProduct();
            $product->updateQuantity($addedQuantity);

            $this->em->persist($product);
            $this->em->flush();
        }
    }
}