<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Supply
 *
 * @ORM\Table(name="supply")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplyRepository")
 */
class Supply
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
     * @ORM\Column(name="document", type="string", length=255)
     */
    private $document;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SupplyProducts", mappedBy="supply", cascade={"persist"})
     */
    private $supplyProducts;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->supplyProducts = new ArrayCollection();
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
     * Set document
     *
     * @param string $document
     *
     * @return Supply
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Supply
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Supply
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Add supplyProduct
     *
     * @param \AppBundle\Entity\SupplyProducts $supplyProduct
     *
     * @return Supply
     */
    public function addSupplyProduct(\AppBundle\Entity\SupplyProducts $supplyProduct)
    {
        $supplyProduct->setSupply($this);
        $this->supplyProducts->add($supplyProduct);

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
}
