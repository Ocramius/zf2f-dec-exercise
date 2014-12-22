<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([
            'category' => 'CATEGORY POSTINGS',
            // add market listings here
        ]);
    }

    public function itemAction()
    {
        $itemId = $this->params()->fromQuery('itemId');

        if (! $itemId) {
            $this->flashMessenger()->addErrorMessage(
                'Provide Item ID is invalid!'
            );

            return $this->redirect()->toRoute(
                'market/category'
            );
        }

        return new ViewModel([
            'itemId' => $itemId,
        ]);
    }
}
