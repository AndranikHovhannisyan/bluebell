<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/27/15
 * Time: 12:25 AM
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function getParent()
    {
        return 'file';
    }

    public function getName()
    {
        return 'picture';
    }
}