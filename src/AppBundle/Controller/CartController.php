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

class CartController extends BaseController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cartAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $carts = $this->getDoctrine()->getRepository('AppBundle:Cart')->findBy(array(
            'userId' => $userId
        ));
        if (!$carts)
        {
            return new Response('<html><body>Twój koszyk jest pusty!</body></html>');
        }
        else
        {
            if($request->getMethod() == 'POST')
            {
                $sum = null;
                $deliveryOptions = $this->getDoctrine()->getRepository('AppBundle:Delivery')->findAll();

                $em = $this->getEntityManager();
                foreach($carts as $cart)
                {
                    $cartId = $cart->getId();
                    $quantity = $request->request->get('quantity_'.$cartId);
                    $cart->setQuantity($quantity);
                    $em->flush();
                    $productPrice = $cart->getProduct()->getPrice();
                    $finalPrice = $quantity * $productPrice;
                    $cart->setFinalPrice($finalPrice);
                    $sum += $finalPrice;
                }

                return $this->render('default/cart.html.twig', array(
                    'carts' => $carts,
                    'sum' => $sum,
                    'deliveryOptions' => $deliveryOptions,
                ));
            }
            else
            {
                $deliveryOptions = $this->getDoctrine()->getRepository('AppBundle:Delivery')->findAll();
                $sum = null;
                foreach($carts as $cart)
                {
                    $quantity = $cart->getQuantity();
                    $productPrice = $cart->getProduct()->getPrice();
                    $finalPrice = $quantity * $productPrice;
                    $cart->setFinalPrice($finalPrice);
                    $sum += $finalPrice;
                }
            }
            return $this->render('default/cart.html.twig', array(
                'carts' => $carts,
                'sum' => $sum,
                'deliveryOptions' => $deliveryOptions
            ));
        }
    }


    /**
     * @Route("/cart/add/{id}", name="addToCart")
     */
    public function addToCartAction($id)
    {
        $userId = $this->getUser()->getId();
        $record = $this->getDoctrine()->getRepository('AppBundle:Cart')->findOneBy(
            array('userId' => $userId, 'productId' => $id));

        if($record)
        {
            return new Response('<html><body>Ten produkt jest już w twoim koszyku!</body></html>');
        }
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->findOneByid($id);
        $user = $this->getUser();
        $cart = new Cart($user, $product);

        $em = $this->getEntityManager();
        $em->persist($cart);
        $em->flush();
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/delete/{id}", name="deleteFromCart")
     */
    public function deleteFromCartAction($id)
    {
        $userId = $this->getUser()->getId();
        $em = $this->getEntityManager();
        $cartProduct = $this->getDoctrine()->getRepository('AppBundle:Cart')->findOneBy(
            array('userId' => $userId, 'productId' => $id));
        $em->remove($cartProduct);
        $em->flush();
        $this->addFlash(
            'deleteFromCartNote',
            'Produkt został pomyślnie usunięty z twojego koszyka!'
        );
        return $this->redirectToRoute('cart');

    }

    /**
     * @Route("/cart/clear", name="clearCart")
     */
    public function clearCartAction()
    {
        $userId = $this->getUser()->getId();
        $cartProducts = $this->getDoctrine()->getRepository('AppBundle:Cart')->findByuserId($userId);

        $em = $this->getEntityManager();
        foreach($cartProducts as $cartProduct)
        {
            $em->remove($cartProduct);
            $em->flush();
        }
        return $this->redirectToRoute('cart');

    }

    /**
     * @Route("/cart/summary", name="summaryCart")
     */
    public function summaryCartAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $carts = $this->getDoctrine()->getRepository('AppBundle:Cart')->findByuserId($userId);
        if (!$carts)
        {
            return new Response('<html><body>Twój koszyk jest pusty!</body></html>');
        }
        else
        {
            if ($request->getMethod() == 'POST')
            {
                $sum = null;

                $deliveryId = $request->request->get('delivery');
                if($deliveryId)
                {
                    $this->get('session')->set('deliveryId', $deliveryId);

                    $deliveryData = $this->getDoctrine()->getRepository('AppBundle:Delivery')->find($deliveryId);
                    $deliveryPrice = $deliveryData->getPrice();

                    $sum += $deliveryPrice;

                    foreach ($carts as $cart)
                    {
                        $quantity = $cart->getQuantity();
                        $productPrice = $cart->getProduct()->getPrice();
                        $finalPrice = $quantity * $productPrice;
                        $cart->setFinalPrice($finalPrice);
                        $sum += $finalPrice;
                    }

                    return $this->render('default/cartSummary.html.twig', array(
                        'carts' => $carts,
                        'deliveryData' => $deliveryData,
                        'sum' => $sum
                    ));
                }
                else
                {
                    $this->addFlash(
                        'noDelivery',
                        'Musisz wybrać opcję dostawy!'
                    );
                    return $this->redirectToRoute('cart');
                }
            }

            else
            {
                return $this->redirectToRoute('cart');
            }

        }
    }
}