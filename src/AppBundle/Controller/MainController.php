<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 8/29/15
 * Time: 10:53 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/homepage/{type}", requirements={"type"="all|bucket|composition|single-flower"}, defaults={"type"="all"}, name="homepage")
     * @Template
     */
    public function homepageAction(Request $request, $type = 'all')
    {
        switch($type){
            case 'bucket':
                $type = Product::BUCKET;
                break;
            case 'composition':
                $type = Product::COMPOSITION;
                break;
            case 'single-flower':
                $type = Product::SINGLE;
                break;
            default:
                $type = null;
        }

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAllProducts($type);

        $paginate  = $this->get('knp_paginator');
        // generate pagination
        $pagination = $paginate->paginate(
            $products,
            $request->query->getInt('page', 1),
           3
        );

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/single/{id}", name="single_product")
     * @Template
     */
    public function singleAction(Product $product)
    {
        return array('product' => $product);
    }


    /**
     * @Route("/product-image/remove/{id}", name="remove_product_image")
     */
    public function removeProductImageAcrion(ProductImage $productImage, Request $request)
    {
        if (!is_null($product = $productImage->getProduct()))
        {
            $product->removeProductImage($productImage);
            $productImages = $product->getProductImage();
            if ($productImage->getList() && $productImages->first()){
                $productImages->first()->setList(true);
            }
            if ($productImage->getCover() && $productImages->first()){
                $productImages->first()->setCover(true);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($productImage);
        $em->flush();

        if (isset($_SERVER['HTTP_REFERER'])){
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        return new Response();
    }

    /**
     * @Route("/about-us", name="about")
     * @Template
     */
    public function aboutAction()
    {
        return [];
    }

    /**
     * @Route("/contact-us", name="contact")
     * @Template
     */
    public function contactAction()
    {
        return [];
    }
}