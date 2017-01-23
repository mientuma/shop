<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplyProducts
 *
 * @ORM\Table(name="supply_products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplyProductsRepository")
 */
class SupplyProducts
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
     * @ORM\Column(name="supplyId", type="integer")
     */
    private $supplyId;

    /**
     * @var int
     *
     * @ORM\Column(name="productId", type="integer")
     */
    private $productId;

    /**
     * @var int
     *
     * @ORM\Column(name="productPrice", type="integer")
     */
    private $productPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="productQuantity", type="integer")
     */
    private $productQuantity;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Supply", inversedBy="supplyProducts")
     * @ORM\JoinColumn(name="supplyId", referencedColumnName="id")
     */
    private $supply;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products", inversedBy="supplyProducts")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    private $product;

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
     * Set supplyId
     *
     * @param integer $supplyId
     *
     * @return SupplyProducts
     */
    public function setSupplyId($supplyId)
    {
        $this->supplyId = $supplyId;

        return $this;
    }

    /**
     * Get supplyId
     *
     * @return int
     */
    public function getSupplyId()
    {
        return $this->supplyId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return SupplyProducts
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
     * @return SupplyProducts
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
     * @return SupplyProducts
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
     * Set supply
     *
     * @param \AppBundle\Entity\Supply $supply
     *
     * @return SupplyProducts
     */
    public function setSupply(\AppBundle\Entity\Supply $supply = null)
    {
        $this->supply = $supply;

        return $this;
    }

    /**
     * Get supply
     *
     * @return \AppBundle\Entity\Supply
     */
    public function getSupply()
    {
        return $this->supply;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Products $product
     *
     * @return SupplyProducts
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
}
