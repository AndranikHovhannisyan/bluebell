<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/29/15
 * Time: 10:53 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template
     */
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $media = $em->getRepository('BBMediaBundle:Gallery')->find(5);
//        return array('media' => $media);
        return array();
    }

    /**
     * @Route("/homepage", name="homepage")
     * @Template
     */
    public function homepageAction()
    {
        return array();
    }
}