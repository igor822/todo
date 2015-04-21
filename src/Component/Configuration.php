<?php

namespace Task\Component;

class Configuration
{
    /**
     * @var File
     */
    private $file;

    private $localConfig = [];

    private $globalConfig = [];

    public function __construct($config = [])
    {
        $this->globalConfig = $config;
        $this->loadConfig();
    }

    public function loadConfig()
    {
        if (!empty($this->localConfig)) {
            return $this->localConfig;
        }

        $pathBuilder = PathnameBuilder::createDirectory($this->globalConfig['cache']['path']);
        $configFile = $pathBuilder->getFullPath($this->globalConfig['cache']['config_file']);
        $this->file = new File($configFile);
        $this->localConfig = $this->file->readJson();

        return $this->getConfig();
    }

    public function save()
    {
        $this->file->truncate();
        $this->file->writeJson($this->localConfig);
    }

    public function getConfig()
    {
        return ['global' => $this->globalConfig, 'local' => $this->localConfig];
    }

    public function addConfig($key, $value)
    {
        $this->localConfig[$key] = $value;
        $this->save();
    }

    public function removeConfig($key)
    {
        unset($this->localConfig[$key]);
        $this->save();
    }
}
