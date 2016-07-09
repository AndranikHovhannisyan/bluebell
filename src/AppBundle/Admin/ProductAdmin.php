<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductImage;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('price')
            ->add('discounts')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('price')
            ->add('discounts')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('type', 'choice', ['choices' => [
                Product::BUCKET => 'Bucket',
                Product::COMPOSITION => 'Composition',
                Product::SINGLE => 'Single flower'
            ] ])
            ->add('name')
            ->add('code')
            ->add('description', 'textarea', array('required' => false))
            ->add('price', 'integer', array('attr' => array('min' => '0')))
            ->add('discounts', 'integer', array('attr' => array('min' => '0', 'max' => '100'), 'required' => false))
            ->add('colors')
            ->add('flowers')
            ->add('productImage', 'bb_multiple_file')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('description')
            ->add('price')
            ->add('discounts')
        ;
    }


    public function preUpdate($object)
    {
        $images = $object->getProductImage();

        if($images) {

            $hasListPhoto = false;
            $hasCoverPhoto = false;

            foreach($images as $image) {
                if (!($image instanceof ProductImage)){
                    $object->removeProductImage($image);
                    continue;
                }

                if ($image->getList() == true){
                    $hasListPhoto = true;
                }
                if ($image->getCover() == true){
                    $hasCoverPhoto = true;
                }

                $this->uploadFile($image);
                $image->setProduct($object);
                $object->addProductImage($image);
            }

            if ($object->getProductImage()->first()){
                if (!$hasListPhoto){
                    $object->getProductImage()->first()->setList(true);
                }
                if (!$hasCoverPhoto){
                    $object->getProductImage()->first()->setCover(true);
                }
            }
        }
    }

    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    private function uploadFile($object)
    {
        if (null == $object->getFile()){
            return;
        }

        // check file name
        if($object->getFileName()){
            // get file path
            $path = $object->getAbsolutePath() . $object->getFileName();
            // check file
            if(file_exists($path) && is_file($path)){
                // remove file
                unlink($path);
            }
        }

        // get file originalName
        $object->setFileOriginalName($object->getFile()->getClientOriginalName());

        // get file
        $path_parts = pathinfo($object->getFile()->getClientOriginalName());

        // generate filename
        if(!$path_parts['extension']){
            $extension = $object->getFile()->getMimeType();
            $extension = substr($extension ,strpos($extension, '/') + 1);
        }else{
            $extension = $path_parts['extension'];
        }

        $object->setFileName(md5(microtime()) . '.' . $extension);
        $object->setFileSize($object->getFile()->getClientSize());
        $object->getFile()->move($object->getAbsolutePath(), $object->getFileName());
        $object->setFile(null);
    }
}
