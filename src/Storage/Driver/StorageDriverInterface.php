<?php declare(strict_types=1);

namespace Task\Storage\Driver;

interface StorageDriverInterface
{
    public function addItem(string $content): int;

    public function removeItem(string $id): void;

    public function getItem(string $id): array;

    public function updateItem(string $id, string $values): array;

    public function getAll();
}
