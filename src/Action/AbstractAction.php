<?php

namespace Task\Action;

use Task\Bootstrap;
use Task\Storage\Storage;

abstract class AbstractAction
{
    /**
     * @var Bootstrap
     */
    private $application;

    /**
     * @var Storage
     */
    private $storage = null;

    public function __construct($bootstrap)
    {
        $this->application = $bootstrap;
    }

    /**
     * @return Storage
     */
    public function getStorage()
    {
        if ($this->storage === null) {
            $this->storage = new Storage($this->application->getConfig());
        }
        return $this->storage;
    }

    abstract public function run();
}
