<?php

namespace Task\Action;

use Symfony\Component\Console\Output\OutputInterface;
use Task\Component\Configuration;

class ConfigAction extends AbstractAction
{
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function addConfig($key, $value)
    {
        $this->configuration->addConfig($key, $value);
    }

    public function printConfigs(OutputInterface $output)
    {
        foreach ($this->configuration->getConfig()['local'] as $key => $value) {
            $output->writeln(
                sprintf("<info>%s</info>\t%s", $key, $value)
            );
        }
    }

    public function run()
    {

    }
}
