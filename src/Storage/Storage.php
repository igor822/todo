<?php

namespace Task\Storage;

class Storage
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    public function __construct($config)
    {
        $this->adapter = new StorageAdapter($config);
    }

    /**
     * @return StorageAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
