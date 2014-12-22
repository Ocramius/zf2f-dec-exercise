<?php

namespace Market\Factory\Form;

use Market\Form\PostFormFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostFormFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return PostFormFilter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PostFormFilter($serviceLocator->get('categories'));
    }
}