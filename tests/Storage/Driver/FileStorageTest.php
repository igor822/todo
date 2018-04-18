<?php

namespace Task\Storage\Driver;

use PHPUnit\Framework\TestCase;

class FileStorageTest extends TestCase
{
    private $tempFile;

    protected function setUp()
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'test');
        parent::setUp();
    }

    public function testInstantiateCorrect()
    {
        $storage = new FileStorage($this->tempFile);

        $this->assertInstanceOf('\Task\Storage\Driver\FileStorage', $storage);
    }

    public function testAddItem()
    {
        $content = 'Teste 123';

        $storage = new FileStorage($this->tempFile);
        $id = $storage->addItem($content);

        $this->assertEquals($content, $storage->getItem($id)['task']['content']);

        return ['storage' => $storage, 'id' => $id];
    }

    /**
     * @param array $content
     *
     * @depends testAddItem
     */
    public function testRemoveItem($content)
    {
        /** @var FileStorage $storage */
        $storage = $content['storage'];

        $storage->removeItem($content['id']);

        $this->assertCount(0, $storage->getAll());
    }
}
