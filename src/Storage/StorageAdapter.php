<?php

namespace Task\Storage;

use Task\Component\PathnameBuilder;
use Task\Constants\DriverType;
use Task\Storage\Driver\FileStorage;
use Task\Storage\Driver\StorageDriverInterface;

class StorageAdapter
{
    /**
     * @var string
     */
    private $storageFile;

    /**
     * @var StorageDriverInterface
     */
    private $driver;

    public function __construct($driver, $storageFile)
    {
        $this->storageFile = $storageFile;
        $this->load($driver);
    }

    public function insert($item)
    {
        return $this->driver->addItem($item);
    }

    public function delete($id)
    {
        $this->driver->removeItem($id);
    }

    public function update($id, $values)
    {
        $this->driver->updateItem($id, $values);
    }

    public function findById($id)
    {
        return $this->driver->getItem($id);
    }

    public function findAll()
    {
        return $this->driver->getAll();
    }

    /**
     * @param StorageDriverInterface $driver
     */
    public function load($driver)
    {
        switch ($driver) {
            case DriverType::FILE:
                $this->driver = new FileStorage($this->storageFile);
                break;
        }
    }
}
