<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Bootstrap;

class TaskHelpCommand extends Command
{
    protected function configure()
    {
        $this->setName('help');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $infoContent = require_once $bootstrap->getAppDir() . '/appInfo.php';
        $output->writeln(sprintf('%s', $infoContent));
    }
}
