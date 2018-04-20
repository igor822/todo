<?php declare(strict_types=1);

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

    private function getNextId()
    {
        $items = $this->getValuesBy('id');
        $id = $this->storage->count() + 1;
        if (count($items)) {
            sort($items);
            $id = array_pop($items);
            $id++;
        }

        return $id;
    }

    /**
     * @param string $content
     * @return int
     */
    public function addItem(string $content): int
    {
        $this->load();
        $id = $this->getNextId();
        $item = [
            'id' => $id,
            'status' => StatusType::TODO,
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
    public function getItem(string $id): array
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

    public function getValuesBy(string $key): array
    {
        $storage = $this->storage->getArrayCopy();
        $items = [];
        foreach ($storage as $item) {
            $items[] = $item[$key];
        }
        return $items;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->storage->getArrayCopy();
    }

    /**
     * @param $id
     */
    public function removeItem(string $id): void
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
    public function updateItem(string $id, string $values): array
    {
        $item = $this->getItem($id);
        $item['task'] = array_merge($item['task'], ['content' => $values]);
        $this->storage->offsetSet($item['index'], $item['task']);
        $this->save();

        return $item['task'];
    }

    public function save(): void
    {
        $this->file->truncate();
        $this->file->writeJson($this->storage->getArrayCopy());
    }
}
