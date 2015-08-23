<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/24/15
 * Time: 12:21 AM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Color
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="color")
 * @ORM\Entity
 */
class Color
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
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="colors")
     */
    protected $products;

    /**
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    protected $code;
}