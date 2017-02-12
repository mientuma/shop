<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getEntityManager()
    {
        $em = $this->getDoctrine()->getManager();
        return $em;
    }

    /**
     * @return \AppBundle\Repository\ProductsRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    public function getProductRepository()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Products');
        return $repository;
    }

}