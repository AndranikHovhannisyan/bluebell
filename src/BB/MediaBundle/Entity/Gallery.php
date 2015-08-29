<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BB\MediaBundle\Entity;

use Sonata\MediaBundle\Entity\BaseGallery as BaseGallery;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Gallery
 * @package BB\MediaBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product", mappedBy="gallery")
     */
    protected $product;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \AppBundle\Entity\Product $product
     * @return $this
     */
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param $media
     * @return bool
     */
    public function hasMedia($media)
    {
        foreach($this->getGalleryHasMedias() as $galleryHasMedia){
            if ($galleryHasMedia->getMedia()->getId() == $media->getId()){
                return true;
            }
        }

        return false;
    }
}