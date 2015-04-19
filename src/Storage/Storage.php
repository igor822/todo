<?php

namespace Task\Storage;

class Storage
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    public function __construct($driver, $storageFile)
    {
        $this->adapter = new StorageAdapter($driver, $storageFile);
    }

    /**
     * @return StorageAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
