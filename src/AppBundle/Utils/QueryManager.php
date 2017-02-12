<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class QueryManager
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function findUserByUsername($username)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('u.roles')
            ->from('AppBundle:User', 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username);

        return $qb->getQuery()->getResult();
    }

}