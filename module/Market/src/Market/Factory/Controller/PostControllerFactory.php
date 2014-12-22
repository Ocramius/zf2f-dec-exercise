<?php

namespace Market\Factory\Controller;

use Market\Controller\PostController;
use Market\Form\PostFormFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return PostController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator \Zend\ServiceManager\AbstractPluginManager */
        $parentLocator = $serviceLocator->getServiceLocator();

        /* @var $categoryFilter PostFormFilter */
        $categoryFilter = $parentLocator->get(PostFormFilter::class);

        return new PostController(
            $parentLocator->get('categories'),
            $categoryFilter
        );
    }
}
