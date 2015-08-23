<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 3/31/15
 * Time: 3:56 PM
 */
namespace BB\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}