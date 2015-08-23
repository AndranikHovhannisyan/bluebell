<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/24/15
 * Time: 12:16 AM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flower
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="flower")
 * @ORM\Entity
 */
class Flower
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="flowers")
     */
    protected $products;
}