<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\InitAction;
use Task\Bootstrap;

class TaskInitCommand extends Command
{
    protected function configure()
    {
        $this->setName('init');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $initAction = new InitAction($bootstrap);
        /** @var DialogHelper $dialog */
        $dialog = $this->getHelperSet()->get('dialog');

        $initAction->setDialog($dialog);
        $initAction->setOutput($output);

        $initAction->run();
    }
}
