<?php

namespace Task\Action;

class ListAction extends AbstractAction
{
    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $items = $storageAdapter->findAll();

        return $items;
    }
}
