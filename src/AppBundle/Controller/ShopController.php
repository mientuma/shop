<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\OrderedProducts;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Supply;
use AppBundle\Entity\SupplyProducts;
use AppBundle\Form\EditProductForm;
use AppBundle\Form\OrderForm;
use AppBundle\Form\Type\SupplyForm;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductForm;
use AppBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Cart;

class ShopController extends BaseController
{
    /**
     * @Route("/shop/", name="shop")
     */
    public function shopAction(Request $request)
    {
        $em = $this->getEntityManager();
        $dql = "SELECT p FROM AppBundle:Products p";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('default/shop.html.twig', array(
            'products' => $result
        ));
    }

    /**
     * @Route("/shop/details/{id}", name="shopproductinfo")
     */
    public function showProductInfoAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->find($id);
        return $this->render('default/shopProductInfo.html.twig', array(
            'product' => $product
        ));
    }
}