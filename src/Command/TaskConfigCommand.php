<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\ConfigAction;
use Task\Bootstrap;

class TaskConfigCommand extends Command
{
    protected function configure()
    {
        $this->setName('config')
             ->addOption('--file-storage', null, InputOption::VALUE_REQUIRED)
             ->addOption('--remove', null, InputOption::VALUE_REQUIRED)
             ->addOption('--list', null, InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $config = $bootstrap->getConfiguration();

        $configAction = new ConfigAction($config);

        $fileStorage = $input->getOption('file-storage');
        if ($fileStorage) {
            $configAction->addConfig('file-storage', $fileStorage);
        }

        $configRemove = $input->getOption('remove');
        if ($configRemove) {
            $configAction->removeConfig($configRemove);
            $output->writeln("<info>Config $configRemove was successful removed</info>");
        }

        if ($input->getOption('list')) {
            $configAction->printConfigs($output);
        }
    }
}
