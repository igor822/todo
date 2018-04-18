<?php

namespace Test\Component;

use Task\Component\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    private $tempFile;

    protected function setUp()
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'test');
        parent::setUp();
    }

    public function testCreateFile()
    {
        $file = new File($this->tempFile, 'a');
        $file->open();

        $this->assertTrue(file_exists($this->tempFile));
        return $file;
    }

    /**
     * @param File $file
     * @return File
     *
     * @depends testCreateFile
     */
    public function testWriteContent(File $file)
    {
        $content = 'teste';
        $file->write($content);
        $this->assertEquals($content, file_get_contents($file->getFilename()));

        return $file;
    }

    /**
     * @param File $file
     *
     * @depends testWriteContent
     */
    public function testReadContent(File $file)
    {
        $items = $file->read();

        $this->assertInternalType('string', $items);
    }
}
