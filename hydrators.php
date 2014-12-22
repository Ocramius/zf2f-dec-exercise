<?php

require_once __DIR__ . '/vendor/autoload.php';

class User
{
    private $username;
    private $password;

    public function setUsername($username)
    {
        $this->username = $username;
    }
}

$data = [
    'username' => 'ocramius',
    'password' => 'supersecret',
];

$hydrator = new \Zend\Stdlib\Hydrator\ObjectProperty();

var_dump($hydrator->hydrate($data, new User()));
