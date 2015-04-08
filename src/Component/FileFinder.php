<?php

namespace Task\Component;

use Task\Constants\PathPattern;

class FileFinder
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function hasHome()
    {
        return strpos($this->path, '%HOME%') !== false ? true : false;
    }

    public function replacePathHome()
    {
        $this->path = str_replace(PathPattern::HOME, getenv('HOME'), $this->path);
    }

    public function getFullPath($filename)
    {
        $this->replacePathHome();
        $fullPath = sprintf('%s/%s', $this->path, $filename);
        return $fullPath;
    }
}
