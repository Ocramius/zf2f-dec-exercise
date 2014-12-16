<?php
namespace Search\Factory;

use Search\Model\ListingsTable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListingsTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
    	// see /path/to/onlinemarket/config/autoload/db.local.php
        $adapter   = $services->get('general-adapter');
        return new ListingsTable('listings', $adapter);
    }
}
