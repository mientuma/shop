<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Cart;
use AppBundle\Entity\OrderedProducts;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Supply;
use AppBundle\Entity\SupplyProducts;
use AppBundle\Form\EditProductForm;
use AppBundle\Form\OrderForm;
use AppBundle\Form\Type\SupplyForm;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\LoginForm;
use AppBundle\Form\RegistrationForm;
use AppBundle\Form\ProductForm;
use AppBundle\Entity\Login;
use AppBundle\Entity\Users;
use AppBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

class DataController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        {
            return $this->render('default/index.html.twig');
        }
    }

    /**
     * @Route("/products", name="showproducts")
     */
    public function showProductsAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Products')->findAll();
        return $this->render('default/showProduct/showProduct.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/products/add", name="addproduct")
     */
    public function addProductAction(Request $request)
    {
        $product = new Products();
        $productForm = $this->createForm(ProductForm::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid())
        {
            $product = $productForm->getData();

            $em = $this->getEntityManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash(
                'addNote',
                'Produkt został pomyślnie dodany!'
            );
            return $this->redirectToRoute('showproducts');
        }
        return $this->render('default/addProduct/AddProducts.html.twig', array(
            'productForm' => $productForm->createView(),
        ));
    }

    /**
     * @Route("/products/details/{id}", name="showproductdetails")
     */
    public function showProductDetailsAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->find($id);
        if(!$product)
        {
            throw $this->createNotFoundException();
        }
        return $this->render('default/showProductDetails/showProductDetails.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/products/edit/{id}", name="editproduct")
     */
    public function editProductAction($id, Request $request)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->find($id);

        $editForm = $this->createForm(EditProductForm::class, $product);

        $editForm->handleRequest($request);
        if($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getEntityManager();
            $product = $em->getRepository('AppBundle:Products')->find($id);
            $product = $editForm->getData();
            $em->flush();
            $this->addFlash(
                'editNote',
                'Produkt został pomyślnie zaktualizowany!'
            );
            return $this->redirectToRoute('showproducts');
        }
        return $this->render('default/editProduct/editProduct.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/products/delete/{id}", name="deleteproduct")
     */
    public function deleteProductAction($id)
    {
        $em = $this->getEntityManager();
        $product = $em->getRepository('AppBundle:Products')->find($id);
        $em->remove($product);
        $em->flush();
        $this->addFlash(
            'deleteNote',
            'Produkt został pomyślnie usunięty!'
        );
        return $this->redirectToRoute('showproducts');

    }

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
        $cart = new Cart();
        $cart->setUser($user);
        $cart->setProduct($product);
        $cart->setQuantity(1);

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
            $deliveryId = $this->get('session')->get('deliveryId');
            $address = $form->get('address')->getData();
            $city = $form->get('city')->getData();
            $postCode = $form->get('postCode')->getData();
            $receiver = $form->get('receiver')->getData();
            $receiverPhoneNumber = $form->get('receiverPhoneNumber')->getData();
            $delivery = $this->getDoctrine()->getRepository('AppBundle:Delivery')->find($deliveryId);
            $orderTime = new \DateTime();
            $status = 'inProgress';

            $order
                ->setUser($user)
                ->setAddress($address)
                ->setCity($city)
                ->setPostCode($postCode)
                ->setReceiver($receiver)
                ->setReceiverPhoneNumber($receiverPhoneNumber)
                ->setDelivery($delivery)
                ->setOrderTime($orderTime)
                ->setStatus($status);

            $em = $this->getEntityManager();
            $em->persist($order);
            $em->flush();

            $order = $this->getDoctrine()->getRepository('AppBundle:Orders')->findOneBy(array(
                'user' => $user, 'address' => $address, 'city' => $city, 'postCode' => $postCode,
                'receiver' => $receiver, 'receiverPhoneNumber' => $receiverPhoneNumber, 'orderTime' =>
                $orderTime, 'status' => $status
            ));

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
     */
    public function orderListAction()
    {
        $user = $this->getUser();
        $orders = $this->getDoctrine()->getRepository('AppBundle:Orders')->findBy(array(
            'user' => $user
        ));

        return $this->render('default/orderList.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * @Route("/order/details/{id}", name="orderDetails")
     */
    public function orderDetailsAction($id)
    {
        $user = $this->getUser();
        $order = $this->getDoctrine()->getRepository('AppBundle:Orders')->findOneBy(array(
            'user' => $user, 'id' => $id
        ));
        $orderDetails = $this->getDoctrine()->getRepository('AppBundle:OrderedProducts')->findBy(array(
            'orderId' => $id
        ));

        $sum = $order->getDelivery()->getPrice();

        foreach ($orderDetails as $orderDetail)
        {
            $quantity = $orderDetail->getProductQuantity();
            $price = $orderDetail->getProductPrice();
            $finalPrice = $quantity * $price;
            $orderDetail->setFinalPrice($finalPrice);
            $sum += $finalPrice;
        }

        return $this->render('default/orderDetails.html.twig', array(
            'orderDetails' => $orderDetails,
            'sum' => $sum,
            'order' => $order
        ));
    }

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

        $sum = $order->getDelivery()->getPrice();

        foreach ($orderDetails as $orderDetail)
        {
            $quantity = $orderDetail->getProductQuantity();
            $price = $orderDetail->getProductPrice();
            $finalPrice = $quantity * $price;
            $orderDetail->setFinalPrice($finalPrice);
            $sum += $finalPrice;
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
            $date = new \DateTime();
            $supply->setDate($date)->setDocument($document)->setUserId(1);
            $em = $this->getEntityManager();
            $em->persist($supply);
            $em->flush();

            $arr = $form->get('supplyProducts')->getData()->toArray();

            $repository = $this->getDoctrine()->getRepository('AppBundle:Products');

            $productsId = array();

            foreach($arr as $inc)
            {
                $id = $inc->getProduct()->getId();
                $product = $repository->findOneBy(array(
                    'id' => $id
                ));
                $addedQuantity = $inc->getProductQuantity();
                $originalQuantity = $product->getQuantity();
                $newQuantity = $originalQuantity+$addedQuantity;
                $product->setQuantity($newQuantity);
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
