<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postCode", type="string", length=255)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="receiver", type="string", length=255)
     */
    private $receiver;

    /**
     * @var string
     *
     * @ORM\Column(name="receiverPhoneNumber", type="string", length=255)
     */
    private $receiverPhoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="deliveryId", type="integer")
     */
    private $deliveryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orderTime", type="datetimetz")
     */
    private $orderTime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderedProducts", mappedBy="order")
     */
    private $orderedProduct;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Delivery", inversedBy="orders")
     * @ORM\JoinColumn(name="deliveryId", referencedColumnName="id")
     */
    private $delivery;

    public function __construct()
    {
        $this->orderTime = new \DateTime();
        $this->orderedProduct = new ArrayCollection();
    }

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Orders
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Orders
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Orders
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     *
     * @return Orders
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     *
     * @return Orders
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set receiverPhoneNumber
     *
     * @param string $receiverPhoneNumber
     *
     * @return Orders
     */
    public function setReceiverPhoneNumber($receiverPhoneNumber)
    {
        $this->receiverPhoneNumber = $receiverPhoneNumber;

        return $this;
    }

    /**
     * Get receiverPhoneNumber
     *
     * @return string
     */
    public function getReceiverPhoneNumber()
    {
        return $this->receiverPhoneNumber;
    }

    /**
     * Set deliveryId
     *
     * @param integer $deliveryId
     *
     * @return Orders
     */
    public function setDeliveryId($deliveryId)
    {
        $this->deliveryId = $deliveryId;

        return $this;
    }

    /**
     * Get deliveryId
     *
     * @return integer
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * Set orderTime
     *
     * @param \DateTime $orderTime
     *
     * @return Orders
     */
    public function setOrderTime($orderTime)
    {
        $this->orderTime = $orderTime;

        return $this;
    }
    
    /**
     * Get orderTime
     *
     * @return \DateTime
     */
    public function getOrderTime()
    {
        return $this->orderTime;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Orders
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Orders
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add orderedProduct
     *
     * @param \AppBundle\Entity\OrderedProducts $orderedProduct
     *
     * @return Orders
     */
    public function addOrderedProduct(\AppBundle\Entity\OrderedProducts $orderedProduct)
    {
        $this->orderedProduct[] = $orderedProduct;

        return $this;
    }

    /**
     * Remove orderedProduct
     *
     * @param \AppBundle\Entity\OrderedProducts $orderedProduct
     */
    public function removeOrderedProduct(\AppBundle\Entity\OrderedProducts $orderedProduct)
    {
        $this->orderedProduct->removeElement($orderedProduct);
    }

    /**
     * Get orderedProduct
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderedProduct()
    {
        return $this->orderedProduct;
    }

    /**
     * Set delivery
     *
     * @param \AppBundle\Entity\Delivery $delivery
     *
     * @return Orders
     */
    public function setDelivery(\AppBundle\Entity\Delivery $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \AppBundle\Entity\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
