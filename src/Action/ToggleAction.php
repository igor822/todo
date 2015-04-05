<?php

namespace Task\Action;

use Task\Constants\StatusType;

class ToggleAction extends AbstractAction
{
    private $content;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $storageAdapter->update($this->content, ['status' => StatusType::CLOSED]);

        return true;
    }
}
