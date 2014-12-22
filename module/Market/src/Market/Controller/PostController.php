<?php

namespace Market\Controller;

use Market\Entity\User;
use Zend\Filter\UriNormalize;
use Zend\Filter\Word\UnderscoreToCamelCase;
use Zend\Filter\Word\UnderscoreToDash;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Factory;
use Zend\Form\Form;
use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Form\Element\Csrf;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    /**
     * @var array
     */
    private $categories;

    /**
     * @var InputFilterInterface
     */
    private $categoryFilter;

    public function __construct(array $categories, InputFilterInterface $categoryFilter)
    {
        $this->categories     = $categories;
        $this->categoryFilter = $categoryFilter;
    }

    public function indexAction()
    {
        /* @var $categoryForm \Zend\Form\Form */
        $categoryForm = (new Factory())->createForm([
            'method'   => 'POST',
            'elements' => [
                'category' => [
                    'spec' => [
                        'name'    => 'category',
                        'type'    => 'text',
                        'options' => [
                            'label' => 'Category'
                        ],
                    ],
                ],
                'title' => [
                    'spec' => [
                        'name'    => 'title',
                        'type'    => 'text',
                        'options' => [
                            'label' => 'Title'
                        ],
                    ],
                ],
                'submitButton' => [
                    'spec' => [
                        'name'    => 'submitButton',
                        'type'    => 'submit',
                        'options' => ['label' => 'Submit!'],
                    ],
                ],
            ],
            'input_filter' => $this->categoryFilter,
        ]);

        if ($postData = $this->params()->fromPost()) {
            $categoryForm->setData($postData);

            if ($categoryForm->isValid()) {
                var_dump($categoryForm->getData());

                die('VALID!');
            } else {
                var_dump($categoryForm->getInputFilter()->getMessages());

                die('INVALID!');
            }
        }

        return new ViewModel([
            'categories'   => $this->categories,
            'categoryForm' => $categoryForm,
        ]);
    }
}
