<?php

namespace Task\Storage;

use Task\Constants\DriverType;
use Task\Storage\Driver\FileStorage;
use Task\Storage\Driver\StorageDriverInterface;

class StorageAdapter
{
    private $config;

    /**
     * @var StorageDriverInterface
     */
    private $driver;

    public function __construct($config)
    {
        $this->config = $config;
        $this->load($config['storage']['driver']);
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
                $filename = sprintf('%s/%s', $this->config['storage']['path'], $this->config['storage']['filename']);
                $this->driver = new FileStorage($filename);
                break;
        }
    }
}
