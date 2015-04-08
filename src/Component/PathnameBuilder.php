<?php

namespace Task\Component;

use Task\Constants\PathPattern;

class PathnameBuilder
{
    private $path;

    private $alternatives;

    public function __construct($path, $alternatives = [])
    {
        $this->path = $path;
        $this->alternatives = $alternatives;
    }

    public function hasHome()
    {
        return strpos($this->path, '%HOME%') !== false ? true : false;
    }

    /**
     * @param string $pathname
     */
    public function replacePathHome($pathname)
    {
        $this->path = str_replace(PathPattern::HOME, getenv('HOME'), $pathname);
    }

    public function createDir($path)
    {
        mkdir($path);
    }

    public function checkAlternatives()
    {
        foreach ($this->alternatives as $alternative) {
            $this->replacePathHome($alternative);
            if (is_dir($this->path)) {
                break;
            }
        }
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getFullPath($filename)
    {
        $this->replacePathHome($this->path);
        if (!is_dir($this->path)) {
            $this->checkAlternatives();
        }

        $fullPath = sprintf('%s/%s', $this->path, $filename);
        return $fullPath;
    }
}
