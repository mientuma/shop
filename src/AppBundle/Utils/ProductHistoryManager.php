<?php

namespace AppBundle\Utils;


use AppBundle\Entity\OrderedProducts;
use AppBundle\Entity\SupplyProducts;
use Doctrine\ORM\EntityManager;
use AppBundle\Utils\ProductHistory;

class ProductHistoryManager
{
    private $supplies;
    private $op;
    private $history;
    protected $em;

    function __construct(SupplyProducts $supplyProducts, OrderedProducts $orderedProducts, EntityManager $entityManager, ProductHistory $productHistory)
    {
        $this->supplies = $supplyProducts;
        $this->op = $orderedProducts;
        $this->history = $productHistory;
        $this->em = $entityManager;
    }

    public function getProductHistory($supplies, $orderedProducts)
    {
        $phArray = array();

        foreach ($supplies as $sp)
        {
            $this->supplies = $sp;
            $time = $this->supplies->getSupply()->getDate();
            $user = $this->supplies->getSupply()->getUserId();
            $quantity = $this->supplies->getProductQuantity();
            $status = 'supply';
            $ph = new ProductHistory();

            $ph->setTime($time);
            $ph->setUser($user);
            $ph->setQuantity($quantity);
            $ph->setStatus($status);

            array_push($phArray, $ph);

        }

        foreach ($orderedProducts as $op)
        {
            $this->op = $op;
            $time = $this->op->getOrder()->getOrderTime();
            $user = $this->op->getOrder()->getUserId();
            $quantity = $this->op->getProductQuantity();
            $status = 'order';
            $ph = new ProductHistory();

            $ph->setTime($time);
            $ph->setUser($user);
            $ph->setQuantity($quantity * -1);
            $ph->setStatus($status);

            array_push($phArray, $ph);

        }

        return $phArray;
    }

    public function arrangeProductHistory($history)
    {
        usort($history, function ($a, $b) {
            return strtotime($a->getTime()->format('Y-m-d H:i:s')) - strtotime($b->getTime()->format('Y-m-d H:i:s'));
        });
        return $history;

    }

    public function setCurrentQuantity($sortHistory)
    {
        $currentQuantity = 0;
        foreach ($sortHistory as $item)
        {
            $this->history = $item;
            $currentQuantity += $this->history->getQuantity();
            $this->history->setCurrentQuantity($currentQuantity);
        }

        return $sortHistory;

    }



}