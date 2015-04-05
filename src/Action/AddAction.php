<?php

namespace Task\Action;

class AddAction extends AbstractAction
{
    private $content;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $id = $storageAdapter->insert($this->content);

        return $id;
    }
}
