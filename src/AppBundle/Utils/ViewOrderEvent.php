<?php

namespace AppBundle\Utils;


use Symfony\Component\EventDispatcher\Event;

class ViewOrderEvent extends Event
{
    private $orderDetails;
    private $sum;

    public function __construct($orderDetails, $sum)
    {
        $this->orderDetails = $orderDetails;
        $this->sum = $sum;
    }

    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    public function getSum()
    {
        return $this->sum;
    }


}