<?php

namespace DbTesting;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

require_once __DIR__ . '/vendor/autoload.php';

class Foo
{
    public $bar;
    public $baz;
}

class FooRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $gateway;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    public function __construct(
        TableGatewayInterface $gateway,
        HydratorInterface $hydrator
    ) {
        $this->gateway = $gateway;
        $this->hydrator = $hydrator;
    }

    public function findAll()
    {
        return iterator_to_array($this->gateway->select());
    }

    public function add(Foo $foo)
    {
        $this->gateway->insert($this->hydrator->extract($foo));
    }
}

$db = new Adapter([
    'driver' => 'pdo',
    'dsn'    => 'sqlite:' . __DIR__ . '/db.sqlite',
]);

$hydrator = new ObjectProperty();
$resulSetPrototype = new HydratingResultSet($hydrator, new Foo());
$fooGateway = new TableGateway('foo', $db, null, $resulSetPrototype);

$fooRepository = new FooRepository($fooGateway, $hydrator);

$foo = new Foo();

$foo->bar = 99999;
$foo->baz = 'baz';

$fooRepository->add($foo);
var_dump($fooRepository->findAll());