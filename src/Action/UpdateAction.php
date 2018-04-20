<?php declare(strict_types=1);

namespace Task\Action;

class UpdateAction extends AbstractAction
{
    private $id;

    private $content;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getTask($id): ?array
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $task = $storageAdapter->findById($id);

        return $task['task'] ?? null;
    }

    public function run(): void
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $storageAdapter->update($this->id, $this->content);
    }
}
