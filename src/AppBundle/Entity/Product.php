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

}