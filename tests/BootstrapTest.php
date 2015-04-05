<?php

namespace Test;

use Task\Bootstrap;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testNotFoundConfigFile()
    {
        $bootstrap = new Bootstrap();
    }
}
