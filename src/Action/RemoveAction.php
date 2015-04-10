<?php

namespace Task\Action;

class RemoveAction extends AbstractAction
{
    private $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $storageAdapter->delete($this->id);
    }
}
