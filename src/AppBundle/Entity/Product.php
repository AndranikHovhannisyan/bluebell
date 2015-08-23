<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/23/15
 * Time: 11:32 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    protected $price;

    /**
     * @ORM\Column(name="discounts", type="float", nullable=true)
     */
    protected $discounts;

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="product")
     */
    protected $pictures;

    /**
     * @ORM\OneToOne(targetEntity="File")
     * @ORM\JoinColumn(name="basic_picture_id", referencedColumnName="id")
     */
    protected $basicPicture;

    /**
     * @ORM\ManyToMany(targetEntity="Flower", mappedBy="products")]
     * @ORM\JoinTable(name="product_flower",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="flower_id", referencedColumnName="id")}
     *      )
     */
    protected $flowers;


    /**
     * @ORM\ManyToMany(targetEntity="Color", mappedBy="products")]
     * @ORM\JoinTable(name="product_color",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="color_id", referencedColumnName="id")}
     *      )
     */
    protected $colors;

    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->flowers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set price
     *
     * @param float $price
     * @return Product
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
     * Set discounts
     *
     * @param float $discounts
     * @return Product
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;

        return $this;
    }

    /**
     * Get discounts
     *
     * @return float 
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * Add pictures
     *
     * @param \AppBundle\Entity\File $pictures
     * @return Product
     */
    public function addPicture(\AppBundle\Entity\File $pictures)
    {
        $this->pictures[] = $pictures;

        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \AppBundle\Entity\File $pictures
     */
    public function removePicture(\AppBundle\Entity\File $pictures)
    {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set basicPicture
     *
     * @param \AppBundle\Entity\File $basicPicture
     * @return Product
     */
    public function setBasicPicture(\AppBundle\Entity\File $basicPicture = null)
    {
        $this->basicPicture = $basicPicture;

        return $this;
    }

    /**
     * Get basicPicture
     *
     * @return \AppBundle\Entity\File 
     */
    public function getBasicPicture()
    {
        return $this->basicPicture;
    }

    /**
     * Add flowers
     *
     * @param \AppBundle\Entity\Flower $flowers
     * @return Product
     */
    public function addFlower(\AppBundle\Entity\Flower $flowers)
    {
        $this->flowers[] = $flowers;

        return $this;
    }

    /**
     * Remove flowers
     *
     * @param \AppBundle\Entity\Flower $flowers
     */
    public function removeFlower(\AppBundle\Entity\Flower $flowers)
    {
        $this->flowers->removeElement($flowers);
    }

    /**
     * Get flowers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFlowers()
    {
        return $this->flowers;
    }

    /**
     * Add colors
     *
     * @param \AppBundle\Entity\Color $colors
     * @return Product
     */
    public function addColor(\AppBundle\Entity\Color $colors)
    {
        $this->colors[] = $colors;

        return $this;
    }

    /**
     * Remove colors
     *
     * @param \AppBundle\Entity\Color $colors
     */
    public function removeColor(\AppBundle\Entity\Color $colors)
    {
        $this->colors->removeElement($colors);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\ProductCategory $category
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\ProductCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\ProductCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
