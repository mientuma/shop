<?php

namespace AppBundle\Utils;

use AppBundle\Entity\OrderedProducts;
use Doctrine\ORM\EntityManager;

class OrderedProductsManager
{
    protected $orderedProduct;
    protected $em;

    public function __construct(OrderedProducts $orderedProducts, EntityManager $entityManager)
    {
        $this->orderedProduct = $orderedProducts;
        $this->em = $entityManager;
    }

    public function countFinalPrice($orderedProducts)
    {
        foreach($orderedProducts as $orderedProduct)
        {
            $this->orderedProduct = $orderedProduct;
            $this->orderedProduct->setFinalPrice();
        }

        return $orderedProducts;
    }

    public function countSum($deliveryPrice, $orderDetails)
    {
        $sum = $deliveryPrice;

        foreach ($orderDetails as $orderRow)
        {
            $this->orderedProduct = $orderRow;
            $sum += $this->orderedProduct->getFinalPrice();
        }

        return $sum;
    }

    public function checkProductStatus($orderedProducts)
    {
        return $neededObjects = array_filter(
            $orderedProducts,
            function ($e)
            {
                return $e->getProductStatus() != 'Towar zarezerwowany';
            }
        );
    }

    public function manageOrderedProductsReservation($orderedProducts)
    {
        foreach ($orderedProducts as $op)
        {
            $this->orderedProduct = $op;

            $product = $this->orderedProduct->getProduct(); // Konkretny produkt z bazy produktów.
            $orderedQuantity = $this->orderedProduct->getProductQuantity(); // Zamawiana ilość.
            $reservation = $this->orderedProduct->getProductReserved(); // Ilość zarezerwowana przy zamówieniu.
            $difference = $orderedQuantity - $reservation; // Różnica między ilością już zarezerwowaną a zamówioną.
            $originalProductQuantity = $product->getQuantity(); // Ilość konkretnego produktu w bazie na teraz.

            if($originalProductQuantity >= $difference) // W db jest wystarczająco produktów, żeby obsłużyć to zamówienie.
            {
                $newProductValue = $originalProductQuantity - $difference;
                $product->setQuantity($newProductValue);

                $this->orderedProduct->setProductReserved($orderedQuantity);
                $this->orderedProduct->setProductStatus('Towar zarezerwowany');
                $this->em->persist($product);
                $this->em->persist($this->orderedProduct);
                $this->em->flush();
            }
            else // W db jest niepełna ilość produktu do obsłużenia tego zamówienia.
            {
                $newReservation = $reservation + $originalProductQuantity;
                $this->orderedProduct->setProductReserved($newReservation);
                $this->orderedProduct->setProductStatus('Towar częściowo zarezerwowany');
                $product->setQuantity(0);
                $this->em->persist($this->orderedProduct);
                $this->em->persist($product);
                $this->em->flush();
            }
        }
    }
}