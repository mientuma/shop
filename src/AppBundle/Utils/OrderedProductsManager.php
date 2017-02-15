<?php

namespace AppBundle\Utils;

use AppBundle\Entity\OrderedProducts;

class OrderedProductsManager
{
    protected $product;

    public function __construct(OrderedProducts $orderedProducts)
    {
        $this->product = $orderedProducts;
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