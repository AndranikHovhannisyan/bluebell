<?php

namespace AppBundle\Admin;

use BB\MediaBundle\Entity\Gallery;
use BB\MediaBundle\Entity\GalleryHasMedia;
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
            ->add('media', null, array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
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
            ->add('name')
            ->add('code')
            ->add('description', 'textarea', array('required' => false))
            ->add('price', 'integer', array('attr' => array('min' => '0')))
            ->add('discounts', 'integer', array('attr' => array('min' => '0', 'max' => '100'), 'required' => false))
            ->add('colors')
            ->add('flowers')
            ->add('gallery', 'sonata_type_model_list', array('required' => false))
            ->add('media', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'default',
                'required' => false
            ))
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

    /**
     * @param mixed $object
     * @return mixed|void
     */
    public function prePersist($object){
        $this->prePersistUpdate($object);
    }

    /**
     * @param mixed $object
     * @return mixed|void
     */
    public function preUpdate($object){
        $this->prePersistUpdate($object);
    }

    /**
     * @param $object
     */
    private function prePersistUpdate($object)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $media = $object->getMedia();

        if (!$object->getGallery()){
            $gallery = new Gallery();
            $gallery->setName($media->getName());
            $gallery->setContext('default');
            $gallery->setDefaultFormat('default_small');
            $gallery->setEnabled(true);
            $object->setGallery($gallery);
        }

        if (!$object->getGallery()->hasMedia($media)){
            $galleryHasMedia = new GalleryHasMedia();
            $galleryHasMedia->setGallery($object->getGallery());
            $galleryHasMedia->setMedia($media);

            $em->persist($galleryHasMedia);
        }
    }
}
