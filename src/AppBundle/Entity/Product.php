<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/23/15
 * Time: 11:32 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Class Product
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProductRepository")
 */
class Product
{
    const BUCKET      = 0;
    const COMPOSITION = 1;
    const SINGLE      = 2;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"product"})
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Groups({"product"})
     */
    protected $name;

    /**
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     * @Groups({"product"})
     */
    protected $code;

    /**
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     * @Groups({"product"})
     */
    protected $description;

    /**
     * @ORM\Column(name="price", type="float", nullable=false)
     *  @Groups({"product"})
     */
    protected $price;

    /**
     * @ORM\Column(name="discounts", type="float", nullable=true)
     * @Groups({"product"})
     */
    protected $discounts;

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
     * @ORM\OneToMany(targetEntity="ProductImage", mappedBy="product", cascade={"persist", "remove"})
     * @Groups({"product_image"})
     */
    protected $productImage;

    /**
     * @ORM\Column(name="type", type="smallint", nullable=false)
     */
    protected $type = self::BUCKET;

    /**
     * @Groups({"product"})
     */
    protected $cachedImage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flowers      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productImage = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param mixed $cachedImage
     */
    public function setCachedImage($cachedImage)
    {
        $this->cachedImage = $cachedImage;
    }

    /**
     * @return mixed
     */
    public function getCachedImage()
    {
        return $this->cachedImage;
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

    /**
     * Add productImage
     *
     * @param \AppBundle\Entity\ProductImage $productImage
     * @return Product
     */
    public function addProductImage(\AppBundle\Entity\ProductImage $productImage)
    {
        $this->productImage[] = $productImage;

        return $this;
    }

    /**
     * Remove productImage
     *
     * @param \AppBundle\Entity\ProductImage $productImage
     */
    public function removeProductImage(\AppBundle\Entity\ProductImage $productImage)
    {
        $this->productImage->removeElement($productImage);
    }

    /**
     * Get productImage
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @return null
     * @VirtualProperty
     * @Groups({"product"})
     */
    public function getListPhotoDownloadLink()
    {
        foreach($this->getProductImage() as $image){
            if ($image->getList()){
                return $image->getDownloadLink();
            }
        }

        if ($this->getProductImage()->first()){
            return $this->getProductImage()->getDownloadLink();
        }

        return null;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
