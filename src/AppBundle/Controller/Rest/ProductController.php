<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 8/1/16
 * Time: 12:15 AM
 */
namespace AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Rest\RouteResource("Product")
 * @Rest\Prefix("/api/v1.0")
 */
class ProductController extends FOSRestController
{
    /**
     * @Rest\Post("/products/{first}/{count}", requirements={"first"="\d+", "count"="\d+"}, name="get_product", options={"method_prefix"=false})
     * @Rest\View(serializerGroups={"product"})
     */
    public function postAction($first, $count)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findAllByFilters($first, $count);

        return $product;
    }
}