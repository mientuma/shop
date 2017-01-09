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
     * @ORM\Column(name="categoryId", type="integer")
     */
    private $categoryId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Cart", mappedBy="product")
     */
    private $cart;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderedProducts", mappedBy="product")
     */
    private $orderedProducts;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    private $category;

    public function __construct()
    {
        $this->bascets = new ArrayCollection();
    }

    public function __construct2()
    {
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
     * @param \DateTime $addTime
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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Products
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }


    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Products
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
