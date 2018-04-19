<?php

namespace Task\Component;

class File
{
    private $filename;

    private $mode;

    private $file;

    public function __construct($filename, $mode = 'a+')
    {
        $this->filename = $filename;
        $this->mode = $mode;
        $this->open();
    }

    public function open()
    {
        $this->file = fopen($this->filename, $this->mode);
    }

    public function isOpen()
    {
        return $this->file !== null ? true : false;
    }

    public function write($string)
    {
        $this->checkOpenFile();
        return fwrite($this->file, $string);
    }

    /**
     * @param array $array
     * @return int
     */
    public function writeJson(array $array)
    {
        return $this->write(json_encode($array));
    }

    public function truncate()
    {
        ftruncate($this->file, 0);
    }

    public function close()
    {
        if ($this->isOpen()) {
            $this->open();
        }
        fclose($this->file);
    }

    private function checkOpenFile()
    {
        if (!$this->isOpen()) {
            $this->open();
        }
    }

    public function read()
    {
        $f = fopen($this->filename, 'r');
        if ($this->hasContent()) {
            $content = fread($f, filesize($this->filename));
            fclose($f);
            return $content;
        }

        return '';
    }

    public function readJson()
    {
        return json_decode($this->read(), true) ?? [];
    }

    public function getFilename()
    {
        return $this->filename;
    }

    private function hasContent()
    {
        return filesize($this->filename) > 0 ? true : false;
    }
}
