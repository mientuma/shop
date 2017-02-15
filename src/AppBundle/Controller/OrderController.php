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


class OrderController extends BaseController
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/order", name="order")
     */
    public function orderAction(Request $request)
    {
        $user = $this->getUser();

        $order = new Orders();

        $form = $this->createForm(OrderForm::class, $order);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $order = $form->getData();
            $deliveryId = $this->get('session')->get('deliveryId');
            $delivery = $this->getDoctrine()->getRepository('AppBundle:Delivery')->find($deliveryId);
            $status = 'inProgress';

            $order
                ->setUser($user)
                ->setDelivery($delivery)
                ->setStatus($status);

            $em = $this->getEntityManager();
            $em->persist($order);
            $em->flush();

            $carts = $this->getDoctrine()->getRepository('AppBundle:Cart')->findByUser($user);

            $cartManager = $this->get('app.order.from.cart.service')->orderCart($carts, $order);

            $order->setStatus('Oczekuje na wpłatę');
            $em->flush();

            return $this->redirectToRoute('orderList');
        }

        return $this->render('default/order.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/order/list", name="orderList")
     * @return Response
     */
    public function orderListAction()
    {
        $orders = $this->get('app.order.service')->getOrders();
        return $this->render('default/orderList.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * @Route("/order/details/{orderId}", name="orderDetails")
     * @param $orderId
     * @return Response
     */
    public function orderDetailsAction($orderId)
    {
        $order = $this->get('app.order.service')->getOrder($orderId);
        $orderedProducts = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findById($orderId);
        $orderDetails = $this->get('app.ordered.products.service')->countFinalPrice($orderedProducts);
        $deliveryPrice = $order->getDelivery()->getPrice();
        $sum = $this->get('app.ordered.products.service')->countSum($deliveryPrice, $orderDetails);

        return $this->render('default/orderDetails.html.twig', array(
            'orderDetails' => $orderDetails,
            'sum' => $sum,
            'order' => $order
        ));
    }
}