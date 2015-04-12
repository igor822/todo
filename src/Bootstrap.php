<?php

namespace Task;

use Task\Exceptions\ConfigNotFoundException;

class Bootstrap
{
    private $config;

    private $appDir;

    public function __construct()
    {
        $this->appDir = __DIR__ . '/../app';
        $configFile = $this->appDir . '/config.php';
        if (!file_exists($configFile)) {
            throw new ConfigNotFoundException('Configuration file does not exists');
        }
        $this->config = require_once $configFile;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function getAppDir()
    {
        return $this->appDir;
    }
}
