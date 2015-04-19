<?php

namespace Task;

use Task\Component\Configuration;
use Task\Exceptions\ConfigNotFoundException;

class Bootstrap
{
    /**
     * @var Configuration
     */
    private $config;

    private $appDir;

    public function __construct()
    {
        $this->appDir = __DIR__ . '/../app';
        $configFile = $this->appDir . '/config.php';
        $this->loadConfig($configFile);
        $this->initialize();
    }

    private function loadConfig($configFile)
    {
        if (!file_exists($configFile)) {
            throw new ConfigNotFoundException('Configuration file does not exists');
        }
        $this->config = require_once $configFile;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->config;
    }

    public function getAppDir()
    {
        return $this->appDir;
    }

    public function initialize()
    {
        $configuration = new Configuration($this->config);
        $this->config = $configuration;
    }
}
