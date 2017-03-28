<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 8/1/16
 * Time: 12:15 AM
 */
namespace AppBundle\Controller\Rest;

use AppBundle\Entity\Product;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Rest\RouteResource("Product")
 * @Rest\Prefix("/api/v1.0")
 */
class ProductController extends FOSRestController
{
    /**
     * @Rest\Post("/products/{first}/{count}", requirements={"first"="\d+", "count"="\d+"}, name="get_product", options={"method_prefix"=false})
     * @Rest\View(serializerGroups={"product", "product_image", "productImage"})
     */
    public function postAction(Request $request, $first, $count)
    {
        $content = $request->getContent();
        $request->request->add(json_decode($content, true));

        $colors  = $request->get('colors');
        $flowers = $request->get('flowers');
        $rawTypes   = $request->get('products');

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAllByFilters($first, $count, $types = [], $flowers, $colors);

        $liipManager = $this->get('liip_imagine.cache.manager');

        foreach($products as $product){
            if ($product->getListPhotoDownloadLink()) {
                try {
                    $product->setCachedImage($liipManager->getBrowserPath($product->getListPhotoDownloadLink(), 'product_list'));
                } catch (\Exception $e) {
                    $product->setCachedImage($product->getListPhotoDownloadLink());
                }
            }
        }

        return $products;
    }

    /**
     * @Rest\View(serializerGroups={"productType"})
     */
    public function getTypesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $productTypes = $em->getRepository('AppBundle:ProductType')->findAll();

        return $productTypes;
    }
}