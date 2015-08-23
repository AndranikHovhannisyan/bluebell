<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/23/15
 * Time: 11:23 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProductCategory
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity
 */
class ProductCategory
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;
}