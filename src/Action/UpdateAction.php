<?php

namespace Task\Action;

class UpdateAction extends AbstractAction
{
    private $id;

    private $content;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTask($id)
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $task = $storageAdapter->findById($id);

        return !empty($task['task']) ? $task['task'] : null;
    }

    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $storageAdapter->update($this->id, $this->content);
    }
}
