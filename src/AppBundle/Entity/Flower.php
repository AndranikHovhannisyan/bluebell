<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/24/15
 * Time: 12:16 AM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Flower
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="flower")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FlowerRepository")
 */
class Flower
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"flower"})
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     * @Groups({"flower"})
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="flowers")
     */
    protected $products;

    /**
     * @ORM\Column(name="is_exists", type="boolean", nullable=true)
     */
    protected $isExists = true;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name ? $this->name : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIsExists()
    {
        return $this->isExists;
    }

    /**
     * @param mixed $isExists
     */
    public function setIsExists($isExists)
    {
        $this->isExists = $isExists;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Flower
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
     * Add products
     *
     * @param \AppBundle\Entity\Product $products
     * @return Flower
     */
    public function addProduct(\AppBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \AppBundle\Entity\Product $products
     */
    public function removeProduct(\AppBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }
}
