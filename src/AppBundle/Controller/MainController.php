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
use Symfony\Component\HttpFoundation\Request;

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
    public function homepageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAllProducts();

        $paginate  = $this->get('knp_paginator');
        // generate pagination
        $pagination = $paginate->paginate(
            $products,
            $request->query->getInt('page', 1),
           3
        );

        return array('pagination' => $pagination);
    }
}