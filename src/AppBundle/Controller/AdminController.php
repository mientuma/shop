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

class AdminController extends BaseController
{
    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/admin/orders", name="adminOrders")
     */
    public function ordersAdminAction()
    {
        $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findAll();

        return $this->render('default/orderListAdmin.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * @Route("/admin/orders/details/{id}", name="adminOrdersDetails")
     */
    public function ordersDetailsAdminAction($id)
    {
        $order = $this->getDoctrine()->getRepository('AppBundle:Orders')->findOneBy(array(
            'id' => $id
        ));
        $orderDetails = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findBy(array(
            'orderId' => $id
        ));
        $newOrder = new OrderedProducts();
        $sum = $order->getDelivery()->getPrice();

        foreach ($orderDetails as $orderDetail)
        {
            $orderDetail->countOrderValue();
            $sum += $orderDetail->getFinalPrice();
        }

        return $this->render('default/orderDetailsAdmin.html.twig', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'sum' => $sum
        ));
    }

    /**
     * @Route("/admin/users", name="adminUsers")
     */
    public function usersAdminAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('default/users.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("/admin/supply", name="adminSupply")
     */
    public function supplyAdminAction(Request $request)
    {
        $supply = new Supply();

        $form = $this->createForm(SupplyForm::class, $supply);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $document = $form->get('document')->getData();
            $supply->setDocument($document)->setUserId(1);
            $em = $this->getEntityManager();
            $em->persist($supply);
            $em->flush();

            $repository = $this->getDoctrine()->getRepository('AppBundle:Products');

            $arr = $form->get('supplyProducts')->getData()->toArray();

            $productsId = array();

            foreach($arr as $inc)
            {
                $id = $inc->getProduct()->getId();
                $product = $repository->findOneBy(array(
                    'id' => $id
                ));
                $addedQuantity = $inc->getProductQuantity();
                $originalQuantity = $product->getQuantity();
                $product->updateQuantity($originalQuantity, $addedQuantity);
                $em->persist($product);
                $em->flush();

                $productsId[] .= $id;
            }

            $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findBy(
                array('status' => 'Oczekuje na wpłatę'),
                array('orderTime' => 'ASC')
            );

            $ordersId = array();
            foreach ($orders as $order)
            {
                $id = $order->getId();
                $ordersId[] .= $id;
            }

            $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findBy(
                array(
                    'orderId' => ($ordersId),
                    'productId' => ($productsId),
                    'productStatus' => array('Towar częściowo zarezerwowany', 'Brak towaru, oczekuje na dostawę')
                )
            );

            foreach ($orderedProducts as $orderedProduct)
            {
                $product = $orderedProduct->getProduct();
                $quantity = $orderedProduct->getProductQuantity();
                $reservation = $orderedProduct->getProductReserved();
                $difference = $quantity - $reservation;
                $databaseQuantity = $this->getDoctrine()->getRepository('AppBundle:Products')->find($product)->getQuantity();

                if($databaseQuantity >= $difference)
                {
                    $newProductValue = $databaseQuantity-$difference;
                    $product->setQuantity($newProductValue);

                    $orderedProduct->setProductReserved($quantity);
                    $orderedProduct->setProductStatus('Towar zarezerwowany');
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($product);
                    $em->persist($orderedProduct);
                    $em->flush();
                }
                elseif($databaseQuantity == 0)
                {
                    break 1;
                }
                else
                {
                    $newReservation = $reservation + $databaseQuantity;
                    $orderedProduct->setProductReserved($newReservation);
                    $orderedProduct->setProductStatus('Towar częściowo zarezerwowany');
                    $product->setQuantity(0);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($orderedProduct);
                    $em->persist($product);
                    $em->flush();
                }
            }

            $this->addFlash(
                'supplyNote',
                'Dostawa została pomyślnie przyjęta!'
            );
            return $this->redirectToRoute('adminSupply');
        }

        return $this->render('default/supply.html.twig', array(
            'form' => $form->createView()
        ));
    }
}