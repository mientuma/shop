<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class OrderManager
{
    protected $em;
    protected $user;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function getOrder($id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('o')
            ->from('AppBundle:Orders', 'o')
            ->where('o.id = :id AND o.user = :user')
            ->setParameters(
                array(
                    'id' => $id,
                    'user' => $this->user
                )
            );

        return $qb->getQuery()->setMaxResults(1)->getOneOrNullResult();
    }

    public function getOrders()
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('o')
            ->from('AppBundle:Orders', 'o')
            ->where('o.user = :user')
            ->setParameter('user', $this->user);

        return $qb->getQuery()->getResult();
    }
}