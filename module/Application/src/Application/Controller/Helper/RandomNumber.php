<?php

namespace Application\Controller\Helper;

use Zend\Mvc\Controller\Plugin\PluginInterface;
use Zend\Stdlib\DispatchableInterface as Dispatchable;

class RandomNumber implements PluginInterface
{
    public function __invoke()
    {
        return rand(0, 10000);
    }

    public function setController(Dispatchable $controller)
    {
    }

    public function getController()
    {
    }
}
