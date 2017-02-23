<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Entity\Supply;
use AppBundle\Form\OrderSelectionForm;
use AppBundle\Form\Type\SupplyForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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
     * @param Request $request
     * @return Response
     * @Route("/admin/orders", name="adminOrders")
     */
    public function ordersAdminAction(Request $request)
    {
        $orders = $this->get('app.order.service')->getOrders();
        $order = new Orders();
        $form = $this->createForm(OrderSelectionForm::class, $order);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $timeRange = $form->get('orderTime')->getData();
            $status = $form->get('status')->getData();
            $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findByTimeRangeAndStatus($timeRange, $status);
        }
        return $this->render('default/orderListAdmin.html.twig', array(
            'orders' => $orders,
            'form' => $form->createView()
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
        $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findByOrderId($orderId);
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
            $this->get('app.supply.manager.service')->addProducts($supplies);

//            $orders = $this->get('app.order.service')->findByPendingStatus();
//            $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findByReservation($orders, $productIds);
//            $this->addFlash(
//                'supplyNote',
//                'Dostawa została pomyślnie przyjęta!'
//            );
//
//            if($orderedProducts)
//            {
//                $this->get('app.ordered.products.service')->manageOrderedProductsReservation($orderedProducts);
//            }
//            return $this->redirectToRoute('adminSupply');
        }

        return $this->render('default/supply.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param $id
     * @return Response
     * @Route("/admin/users/{id}", name="adminUserView")
     */
    public function userDetailsAdminAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if(!$user)
        {
            throw $this->createNotFoundException('W bazie nie ma użytkownika o takim Id!');
        }
        $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findByUser($user);
        return $this->render('default/userView.html.twig', array(
            'user' => $user,
            'orders' => $orders
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("admin/orders/update/{id}", name="adminUpdateSingleOrder")
     */
    public function updateSingleOrder($id)
    {
        $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findByOrderId($id);
        return $this->orderUpdateAdminAction($orderedProducts);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("admin/omg", name="adminUpdateAllOrders")
     */
    public function updateAllOrders()
    {
        $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findAllPending();
        return $this->orderUpdateAdminAction($orderedProducts);
    }

    /**
     * @param $orderedProducts
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("dupa/", name="adminOrderUpdate")
     */
    public function orderUpdateAdminAction($orderedProducts)
    {
        $orderedProducts = $this->get('app.ordered.products.service')->checkProductStatus($orderedProducts);
        $this->get('app.ordered.products.service')->manageOrderedProductsReservation($orderedProducts);
        return $this->redirectToRoute('adminOrders');
    }
}