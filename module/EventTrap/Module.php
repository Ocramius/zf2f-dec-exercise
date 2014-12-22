<?php

namespace EventTrap;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\View\Http\CreateViewModelListener;

class Module implements InitProviderInterface
{
    public function init(ModuleManagerInterface $manager)
    {
        $shevm = $manager->getEventManager()->getSharedManager();

        /*$nesting = 0;

        $shevm->attach(
            '*',
            '*',
            function (EventInterface $event) use (& $nesting) {
                $nesting += 1;

                var_dump(
                    $nesting
                    . ' - START: '
                    . $event->getName()
                    . ' '
                    . get_class($event->getTarget())
                );
            },
            10000
        );

        $shevm->attach(
            '*',
            '*',
            function (EventInterface $event) use (& $nesting) {
                var_dump(
                    $nesting
                    . ' - END: '
                    . $event->getName()
                    . ' '
                    . get_class($event->getTarget())
                );

                $nesting -= 1;
            },
            -10000
        );*/

        /*$shevm->attach(
            '*',
            MvcEvent::EVENT_ROUTE,
            function (MvcEvent $event) {
                var_dump($event->getRouteMatch());

                die();
            },
            -10
        );*/
    }
}
