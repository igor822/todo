<?php

namespace Test;

use Task\Bootstrap;
use PHPUnit\Framework\TestCase;

class BootstrapTest extends TestCase
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
