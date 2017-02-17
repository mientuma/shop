<?php

namespace AppBundle\Repository;

/**
 * OrderedProductsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderedProductsRepository extends \Doctrine\ORM\EntityRepository
{
    public function findById($orderId)
    {
        return $this->findBy(array(
            'orderId' => $orderId
        ));
    }

    public function findByReservation($orders, $productIds)
    {
        return $this->findBy(
            array(
                'orderId' => ($orders),
                'productId' => ($productIds),
                'productStatus' => array('Częściowa rezerwacja, oczekuje na dostawę', 'Brak towaru, oczekuje na dostawę')
            )
        );
    }
}
