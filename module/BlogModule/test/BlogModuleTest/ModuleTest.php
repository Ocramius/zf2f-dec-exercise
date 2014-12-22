<?php

namespace BlogModuleTest;

use BlogModule\Module;
use PHPUnit_Framework_TestCase;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $this->assertInstanceOf(Module::class, new Module());
    }

    public function testWillProvideConfiguration()
    {
        $this->assertInternalType('array', (new Module())->getConfig());
    }
}
