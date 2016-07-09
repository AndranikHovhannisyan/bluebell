<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 7/9/16
 * Time: 7:19 PM
 */
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        $menu['Home']->addChild('Bucket', array('route' => 'homepage', 'routeParameters' => ['type' => 'bucket']));
        $menu['Home']->addChild('Composition', array('route' => 'homepage', 'routeParameters' => ['type' => 'composition']));
        $menu['Home']->addChild('Single Flower', array('route' => 'homepage', 'routeParameters' => ['type' => 'single-flower']));


//
//        // create another menu item
//        $menu->addChild('About Me', array('route' => 'about'));
//        // you can also add sub level's to your menu's as follows
//        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        // ... add more children

        return $menu;
    }
}