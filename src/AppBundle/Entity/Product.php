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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProductRepository")
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    protected $code;

    /**
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    protected $price;

    /**
     * @ORM\Column(name="discounts", type="float", nullable=true)
     */
    protected $discounts;

    /**
     * @ORM\OneToOne(targetEntity="BB\MediaBundle\Entity\Gallery", inversedBy="product")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    protected $gallery;

    /**
     * @ORM\OneToOne(targetEntity="BB\MediaBundle\Entity\Media", inversedBy="product")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;

    /**
     * @ORM\ManyToMany(targetEntity="Flower", inversedBy="products")
     * @ORM\JoinTable(name="product_flower",
     *      joinColumns={@ORM\JoinColumn(name="flower_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    protected $flowers;


    /**
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="products")
     * @ORM\JoinTable(name="product_color",
     *      joinColumns={@ORM\JoinColumn(name="color_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    protected $colors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flowers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name ? $this->name : '';
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
     * Set gallery
     *
     * @param \BB\MediaBundle\Entity\Gallery $gallery
     * @return Product
     */
    public function setGallery(\BB\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \BB\MediaBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set media
     *
     * @param \BB\MediaBundle\Entity\Media $media
     * @return Product
     */
    public function setMedia(\BB\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \BB\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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
}
