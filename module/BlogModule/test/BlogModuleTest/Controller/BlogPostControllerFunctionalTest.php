<?php

namespace BlogModuleTest\Controller;

use Zend\Http\Response;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class BlogPostControllerFunctionalTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig([
            'modules' => [
                'BlogModule',
            ],
            'module_listener_options' => [
                'module_paths' => [],
                'config_glob_paths' => [],
            ],
        ]);

        parent::setUp();
    }

    public function testDispatchesController()
    {
        $this->dispatch('/blog/123');
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
        $this->assertControllerClass('BlogPostController');
        $this->assertControllerName('blog-post-controller');
        $this->assertMatchedRouteName('blog/post');
    }
}
