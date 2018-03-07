<?php

namespace Samknows\Tests\Setup;

use PHPUnit\Framework\TestCase;
use Samknows\Tool\Application;
use DI\Container;

class CommadTestCase extends TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Application
     */
    protected $application;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $container = require_once __DIR__ . '/../../../../config/bootstrap.php';
        $this->setContainer($container);
        $application = new Application($container);
        $this->setApplication($application);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return CommadTestCase
     */
    public function setContainer(Container $container): CommadTestCase
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return Application
     */
    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * @param Application $application
     * @return CommadTestCase
     */
    public function setApplication(Application $application): CommadTestCase
    {
        $this->application = $application;
        return $this;
    }

}