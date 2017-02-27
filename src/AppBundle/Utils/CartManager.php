<?php

namespace AppBundle\Utils;


use AppBundle\Entity\Cart;
use AppBundle\Entity\OrderedProducts;
use Doctrine\ORM\EntityManager;

class CartManager
{
    protected $cartRow;
    protected $em;

    public function __construct(Cart $cart, EntityManager $entityManager)
    {
        $this->cartRow = $cart;
        $this->em = $entityManager;
    }

    public function orderCart($carts, $order)
    {
        foreach ($carts as $cart)
        {
            $this->cartRow = $cart;
            $product = $this->cartRow->getProduct();
            $quantity = $this->cartRow->getQuantity();
            $productPrice = $this->cartRow->getProduct()->getPrice();
            $orderProduct = new OrderedProducts();

            $orderProduct
                ->setOrder($order)
                ->setProduct($product)
                ->setProductPrice($productPrice)
                ->setProductQuantity($quantity);

            $productQuantity = $product->getQuantity();

            if($productQuantity >= $quantity)
            {
                $orderProduct
                    ->setProductStatus('Towar zarezerwowany')
                    ->setProductReserved($quantity);
                $finalQuantity = $productQuantity - $quantity;
                $product->setQuantity($finalQuantity);
            }
            elseif($productQuantity !== 0)
            {
                $orderProduct
                    ->setProductStatus('Częściowa rezerwacja, oczekuje na dostawę')
                    ->setProductReserved($productQuantity);
                $product->setQuantity(0);
            }
            else
            {
                $orderProduct
                    ->setProductStatus('Brak towaru, oczekuje na dostawę')
                    ->setProductReserved(0);
            }

            $this->em->persist($orderProduct);
            $this->em->remove($cart);
            $this->em->flush();
        }
    }


}