<?php

namespace Task;

use Task\Exceptions\ConfigNotFoundException;

class Bootstrap
{
    private $config;

    public function __construct()
    {
        $configFile = __DIR__ . '/../app/config.php';
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
}
