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
            $product = $this->product->getProduct(); // Konkretny produkt z bazy produktów.
            $orderedQuantity = $this->product->getProductQuantity(); // Zamawiana ilość.
            $reservation = $this->product->getProductReserved(); // Ilość zarezerwowana przy zamówieniu.
            $difference = $orderedQuantity - $reservation; // Różnica między ilością już zarezerwowaną a zamówioną.
            $originalProductQuantity = $product->getQuantity(); // Ilość konkretnego produktu w bazie na teraz.

            if($originalProductQuantity >= $difference) // W db jest wystarczająco produktów, żeby obsłużyć to zamówienie.
            {
                $newProductValue = $originalProductQuantity - $difference;
                $product->setQuantity($newProductValue);

                $this->product->setProductReserved($orderedQuantity);
                $this->product->setProductStatus('Towar zarezerwowany');
                $this->em->persist($product);
                $this->em->persist($this->product);
                $this->em->flush();
            }
            elseif($originalProductQuantity == 0) // Brak produktu w bazie.
            {
                break 1;
            }
            else // W db jest niepełna ilość produktu do obsłużenia tego zamówienia.
            {
                $newReservation = $reservation + $originalProductQuantity;
                $this->product->setProductReserved($newReservation);
                $this->product->setProductStatus('Towar częściowo zarezerwowany');
                $product->setQuantity(0);
                $this->em->persist($this->product);
                $this->em->persist($product);
                $this->em->flush();
            }
        }
    }
}