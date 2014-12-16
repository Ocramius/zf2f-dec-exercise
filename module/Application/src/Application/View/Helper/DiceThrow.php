<?php

namespace Application\View\Helper;

use Zend\View\Helper\HelperInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class DiceThrow implements HelperInterface
{
    public function __invoke($sides)
    {
        return rand(1, $sides);
    }

    public function setView(Renderer $view)
    {
    }

    public function getView()
    {
    }
}