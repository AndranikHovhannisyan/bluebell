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
use JMS\Serializer\SerializationContext;
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
     * @Route("/homepage", name="homepage")
     * @Template
     */
    public function homepageAction(Request $request, $type = 'all')
    {
        $em = $this->getDoctrine()->getManager();
        $flowers = $em->getRepository('AppBundle:Flower')->findAll();
        $colors = $em->getRepository('AppBundle:Color')->findAll();

        $serializer = $this->get('serializer');
        $flowers = $serializer->serialize($flowers, 'json', SerializationContext::create()->setGroups(['flower']));
        $colors = $serializer->serialize($colors, 'json', SerializationContext::create()->setGroups(['color']));


        return [
            'flowers' => $flowers,
            'colors' => $colors
        ];
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
}