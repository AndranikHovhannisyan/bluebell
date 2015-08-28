<?php

namespace AppBundle\Admin;

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
            ->add('category')
            ->add('price', 'integer', array('attr' => array('min' => '0')))
            ->add('discounts', 'integer', array('attr' => array('min' => '0', 'max' => '100'), 'required' => false))
            ->add('colors')
            ->add('flowers')
            ->add('media', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'main_gallery')))
            ->add('gallery', 'sonata_type_model_list', array ('required' => false), array ('link_parameters' => array ('context' => 'main_gallery')))

//            ->add('gallery', 'sonata_type_model')
//            ->add('media', 'sonata_type_model')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('price')
            ->add('discounts')
        ;
    }
}
