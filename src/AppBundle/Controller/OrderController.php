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

            $carts = $this->getDoctrine()->getRepository('AppBundle:Cart')->findBy(array(
                'user' => $user
            ));

            foreach ($carts as $cart)
            {
                $orderProduct = new OrderedProducts();
                $product = $cart->getProduct();
                $quantity = $cart->getQuantity();
                $productPrice = $cart->getProduct()->getPrice();

                $orderProduct
                    ->setOrder($order)
                    ->setProduct($product)
                    ->setProductPrice($productPrice)
                    ->setProductQuantity($quantity);

                $productQuantity = $product->getQuantity();

                if($productQuantity >= $quantity)
                {
                    $orderProduct
                        ->setProductStatus('Dostępny, zarezerwowany')
                        ->setProductReserved($quantity);
                    $finalQuantity = $productQuantity - $quantity;
                    $product->setQuantity($finalQuantity);
                }
                elseif($productQuantity !== 0)
                {
                    $orderProduct
                        ->setProductStatus('Częściowa rezerwacja, oczekuje na dostawę')
                        ->setProductReserved($productQuantity);
                    $product->setQuantity(0);
                }
                else
                {
                    $orderProduct
                        ->setProductStatus('Brak towaru, oczekuje na dostawę')
                        ->setProductReserved(0);
                }

                $em->persist($orderProduct);
                $em->remove($cart);
                $em->flush();
            }

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
        $orders = $this->get('orderservice')->getOrders();
        return $this->render('default/orderList.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * @Route("/order/details/{id}", name="orderDetails")
     * @param $id
     * @return Response
     */
    public function orderDetailsAction($id)
    {
        $order = $this->get('orderservice')->getOrder($id);
        $orderDetails = $this->get('orderedproductservice')->getOrderedProducts($id);

        $sum = $order->getDelivery()->getPrice();
        foreach ($orderDetails as $orderDetail)
        {
            $orderDetail->countOrderValue();
            $sum += $orderDetail->getFinalPrice();
        }

        return $this->render('default/orderDetails.html.twig', array(
            'orderDetails' => $orderDetails,
            'sum' => $sum,
            'order' => $order
        ));
    }
}