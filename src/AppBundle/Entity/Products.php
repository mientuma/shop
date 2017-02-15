<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductsRepository")
 */
class Products
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
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @Assert\Length(
     * min = 3,
     * max = 40,
     * minMessage = "Nazwa produktu musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Nazwa produktu może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     *
     * @Assert\GreaterThan(
     *     value = 0,
     *     message="Podano nieprawidłową wartość!"
     * )
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @Assert\Length(
     * min = 3,
     * max = 1000,
     * minMessage = "Opis produktu musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Opis produktu może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="addTime", type="datetime")
     */
    private $addTime;

    /**
     * @var int
     *
     * @ORM\Column(name="subCategoryId", type="integer")
     */
    private $subCategoryId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Cart", mappedBy="product")
     */
    private $cart;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderedProducts", mappedBy="product")
     */
    private $orderedProducts;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubCategory", inversedBy="products")
     * @ORM\JoinColumn(name="subCategoryId", referencedColumnName="id")
     */
    private $subCategory;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SupplyProducts", mappedBy="product")
     */
    private $supplyProducts;

    private $addedQuantity;


    public function __construct()
    {
        $this->quantity = 0;
        $this->addTime = new \DateTime();
        $this->supplyProducts = new ArrayCollection();
        $this->cart = new ArrayCollection();
        $this->orderedProducts = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Products
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set addTime
     *
     * @return Products
     */
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;

        return $this;
    }

    /**
     * Get addTime
     *
     * @return \DateTime
     */
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * Add cart
     *
     * @param \AppBundle\Entity\Cart $cart
     *
     * @return Products
     */
    public function addCart(\AppBundle\Entity\Cart $cart)
    {
        $this->cart[] = $cart;

        return $this;
    }

    /**
     * Remove cart
     *
     * @param \AppBundle\Entity\Cart $cart
     */
    public function removeCart(\AppBundle\Entity\Cart $cart)
    {
        $this->cart->removeElement($cart);
    }

    /**
     * Get cart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add orderedProduct
     *
     * @param \AppBundle\Entity\OrderedProducts $orderedProduct
     *
     * @return Products
     */
    public function addOrderedProduct(\AppBundle\Entity\OrderedProducts $orderedProduct)
    {
        $this->orderedProducts[] = $orderedProduct;

        return $this;
    }

    /**
     * Remove orderedProduct
     *
     * @param \AppBundle\Entity\OrderedProducts $orderedProduct
     */
    public function removeOrderedProduct(\AppBundle\Entity\OrderedProducts $orderedProduct)
    {
        $this->orderedProducts->removeElement($orderedProduct);
    }

    /**
     * Get orderedProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderedProducts()
    {
        return $this->orderedProducts;
    }


    /**
     * Set subCategoryId
     *
     * @param integer $subCategoryId
     *
     * @return Products
     */
    public function setSubCategoryId($subCategoryId)
    {
        $this->subCategoryId = $subCategoryId;

        return $this;
    }


    /**
     * Get subCategoryId
     *
     * @return integer
     */
    public function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    /**
     * Set subCategory
     *
     * @param \AppBundle\Entity\SubCategory $subCategory
     *
     * @return Products
     */
    public function setSubCategory(\AppBundle\Entity\SubCategory $subCategory = null)
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * Get subCategory
     *
     * @return \AppBundle\Entity\SubCategory
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Products
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Add supplyProduct
     *
     * @param \AppBundle\Entity\SupplyProducts $supplyProduct
     *
     * @return Products
     */
    public function addSupplyProduct(\AppBundle\Entity\SupplyProducts $supplyProduct)
    {
        $this->supplyProducts[] = $supplyProduct;

        return $this;
    }

    /**
     * Remove supplyProduct
     *
     * @param \AppBundle\Entity\SupplyProducts $supplyProduct
     */
    public function removeSupplyProduct(\AppBundle\Entity\SupplyProducts $supplyProduct)
    {
        $this->supplyProducts->removeElement($supplyProduct);
    }

    /**
     * Get supplyProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplyProducts()
    {
        return $this->supplyProducts;
    }

    public function getAddedQuantity()
    {
        return $this->addedQuantity;
    }

    public function setAddedQuantity($addedQuantity)
    {
        $this->addedQuantity = $addedQuantity;
    }


    // Own Methods


    public function updateQuantity($addedQuantity)
    {
        $newQuantity = $this->getQuantity() + $addedQuantity;
        $this->setQuantity($newQuantity);
    }

}
