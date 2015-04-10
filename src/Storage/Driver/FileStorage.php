<?php

namespace Task\Storage\Driver;

use Task\Component\File;
use Task\Constants\StatusType;

class FileStorage implements StorageDriverInterface
{
    /**
     * @var File
     */
    private $file = null;

    /**
     * @var \ArrayObject
     */
    private $storage;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->file = new File($filename);
        $this->load();
    }

    public function load()
    {
        try {
            $content = $this->file->readJson();
            $this->storage = new \ArrayObject($content);
        } catch (\Exception $e) {
            $this->storage = new \ArrayObject();
        }
    }

    public function clean()
    {
        $this->file->write('');
    }

    /**
     * @param string $content
     * @return int
     */
    public function addItem($content)
    {
        $this->load();
        $id = $this->storage->count() + 1;
        $item = [
            'id' => $id,
            'status' => StatusType::OPEN,
            'content' => $content
        ];
        $this->storage->append($item);
        $this->save();

        return $id;
    }

    /**
     * @param $id
     * @return null
     */
    public function getItem($id)
    {
        $value = null;
        $checkItem = function($index, $item, $id) use (&$value) {
            if ((int) $item['id'] == $id) {
                $value['task'] = $item;
                $value['index'] = $index;
            }
        };

        $iterator = $this->storage->getIterator();
        while ($iterator->valid()) {
            $checkItem($iterator->key(), $iterator->current(), $id);
            $iterator->next();
        }
        return $value;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->storage->getArrayCopy();
    }

    /**
     * @param $id
     */
    public function removeItem($id)
    {
        $task = $this->getItem($id);
        $this->storage->offsetUnset($task['index']);
        $this->save();
    }

    /**
     * @param $id
     * @param $values
     * @return mixed
     */
    public function updateItem($id, $values)
    {
        $item = $this->getItem($id);
        $values = array_merge($item['task'], $values);
        $this->storage->offsetSet($item['index'], $values);
        $this->save();

        return $item['task'];
    }

    public function save()
    {
        $this->file->truncate();
        $this->file->writeJson($this->storage->getArrayCopy());
    }
}
