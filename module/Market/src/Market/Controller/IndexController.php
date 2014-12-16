<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexAction()
    {
        return new ViewModel([
            'users'         => $this->userRepository->findAll(),
            'createUserUrl' => $this->url()->fromRoute('admin/user/create'),
        ]);
    }

    public function registerAction()
    {
        // ...


        if ($form->isValid()) {
            // ...

            return $this->redirect()->toRoute('user/profile');
        }
    }
}
