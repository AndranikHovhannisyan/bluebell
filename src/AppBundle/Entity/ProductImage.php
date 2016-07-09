<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 7/9/16
 * Time: 2:05 PM
 */
namespace AppBundle\Entity;

use AppBundle\Traits\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ProductImage
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="product_image")
 */
class ProductImage
{
    use File;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productImage")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;


    /**
     * @ORM\Column(type="boolean", name="list_image", nullable=true)
     */
    protected $list;

    /**
     * @ORM\Column(type="boolean", name="cover_image", nullable=true)
     */
    protected $cover;

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
     * Set list
     *
     * @param boolean $list
     * @return ProductImage
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return boolean 
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set cover
     *
     * @param boolean $cover
     * @return ProductImage
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return boolean 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return ProductImage
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
