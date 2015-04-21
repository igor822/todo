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

    private $loadedConfig = false;

    public function __construct($config = [])
    {
        $this->globalConfig = $config;
        $this->setDefaultConfig($config);
        $this->loadConfig();
    }

    private function setDefaultConfig($config)
    {
        $this->localConfig = $config['storage'];

        $fileStorage = $config['storage']['file-storage'];
        $pathBuilder = new PathnameBuilder($fileStorage);
        $this->localConfig['file-storage'] = $pathBuilder->replacePathHome($fileStorage);
    }

    public function loadConfig()
    {
        if ($this->loadedConfig) {
            return $this->localConfig;
        }

        $pathBuilder = PathnameBuilder::createDirectory($this->globalConfig['cache']['path']);
        $configFile = $pathBuilder->getFullPath($this->globalConfig['cache']['config_file']);
        $this->file = new File($configFile);
        $this->localConfig = array_merge($this->localConfig, $this->file->readJson());
        $this->loadedConfig = true;

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
