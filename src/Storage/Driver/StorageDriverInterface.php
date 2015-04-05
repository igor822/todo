<?php

namespace Task\Storage\Driver;

interface StorageDriverInterface
{
    public function addItem($item);

    public function removeItem($id);

    public function getItem($id);

    public function updateItem($id, $values);

    public function getAll();
}
