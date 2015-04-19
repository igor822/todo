<?php

namespace Task\Action;

use Task\Bootstrap;
use Task\Component\PathnameBuilder;
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
            $configuration = $this->application->getConfiguration();
            $driver = $configuration->getConfig()['global']['storage']['driver'];
            $storageFile = $configuration->getConfig()['local']['file-storage'];
            $this->storage = new Storage($driver, $storageFile);
        }
        return $this->storage;
    }

    abstract public function run();
}
