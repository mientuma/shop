<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderedProducts
 *
 * @ORM\Table(name="ordered_products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderedProductsRepository")
 */
class OrderedProducts
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="orderId", type="integer")
     */
    private $orderId;

    /**
     * @var int
     *
     * @ORM\Column(name="productId", type="integer")
     */
    private $productId;

    /**
     * @var float
     *
     * @ORM\Column(name="productPrice", type="float")
     */
    private $productPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="productQuantity", type="integer")
     */
    private $productQuantity;

    /**
     * @var string
     *
     * @ORM\Column(name="productStatus", type="string", length=255)
     */
    private $productStatus;

    /**
     * @var int
     *
     * @ORM\Column(name="productReserved", type="integer")
     */
    private $productReserved;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Orders", inversedBy="orderedProduct")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products", inversedBy="orderedProducts")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    private $product;

    private $finalPrice;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return OrderedProducts
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return OrderedProducts
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set productPrice
     *
     * @param integer $productPrice
     *
     * @return OrderedProducts
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get productPrice
     *
     * @return int
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set productQuantity
     *
     * @param integer $productQuantity
     *
     * @return OrderedProducts
     */
    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * Get productQuantity
     *
     * @return int
     */
    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    /**
     * Set order
     *
     * @param \AppBundle\Entity\Orders $order
     *
     * @return OrderedProducts
     */
    public function setOrder(\AppBundle\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\Orders
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Products $product
     *
     * @return OrderedProducts
     */
    public function setProduct(\AppBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    public function setFinalPrice()
    {
        $quantity = $this->getProductQuantity();
        $price = $this->getProductPrice();
        $finalPrice = $quantity * $price;
        $this->finalPrice = $finalPrice;
    }


    /**
     * Set productStatus
     *
     * @param string $productStatus
     *
     * @return OrderedProducts
     */
    public function setProductStatus($productStatus)
    {
        $this->productStatus = $productStatus;

        return $this;
    }

    /**
     * Get productStatus
     *
     * @return string
     */
    public function getProductStatus()
    {
        return $this->productStatus;
    }

    /**
     * Set productReserved
     *
     * @param integer $productReserved
     *
     * @return OrderedProducts
     */
    public function setProductReserved($productReserved)
    {
        $this->productReserved = $productReserved;

        return $this;
    }

    /**
     * Get productReserved
     *
     * @return integer
     */
    public function getProductReserved()
    {
        return $this->productReserved;
    }

    // Own Methods

}
