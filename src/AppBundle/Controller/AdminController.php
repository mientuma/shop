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
     * @return Response
     * @Route("/admin/orders", name="adminOrders")
     */
    public function ordersAdminAction()
    {
        $orders = $this->get('app.order.service')->getOrders();
        return $this->render('default/orderListAdmin.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * @param $orderId
     * @return Response
     * @Route("/admin/orders/details/{orderId}", name="adminOrdersDetails")
     */
    public function ordersDetailsAdminAction($orderId)
    {
        $order = $this->getDoctrine()->getRepository('AppBundle:Orders')->find($orderId);
        $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findById($orderId);
        $orderDetails = $this->get('app.ordered.products.service')->countFinalPrice($orderedProducts);
        $deliveryPrice = $order->getDelivery()->getPrice();
        $sum = $this->get('app.ordered.products.service')->countSum($deliveryPrice, $orderDetails);

        return $this->render('default/orderDetailsAdmin.html.twig', array(
            'orderDetails' => $orderDetails,
            'sum' => $sum,
            'order' => $order
        ));
    }

    /**
     * @return Response
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

            $supplies = $form->get('supplyProducts')->getData()->toArray();

            $productIds = $this->get('app.supply.manager.service')->addProducts($supplies);
            $orders = $this->get('app.order.service')->findByPendingStatus();
            $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findByReservation($orders, $productIds);
            $this->addFlash(
                'supplyNote',
                'Dostawa została pomyślnie przyjęta!'
            );

            if($orderedProducts)
            {
                $this->get('app.ordered.products.service')->manageOrderedProductsReservation($orderedProducts);
            }
            return $this->redirectToRoute('adminSupply');
        }

        return $this->render('default/supply.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param $id
     * @return Response
     * @Route("/sample/{id}", name="sample")
     */
    public function sampleAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findByUser($user);
        return $this->render('default/userView.html.twig', array(
            'user' => $user,
            'orders' => $orders
        ));
    }
}