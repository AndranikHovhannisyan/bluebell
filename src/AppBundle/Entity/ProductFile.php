<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/24/15
 * Time: 12:08 AM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProductFile
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="product_file")
 * @ORM\Entity
 */
class ProductFile extends File
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="pictures")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;
}