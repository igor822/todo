<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\AddAction;
use Task\Bootstrap;

class TaskAddCommand extends Command
{
    protected function configure()
    {
        $this->setName('add')
             ->setAliases(['a'])
             ->setDescription('Add a new task')
             ->setDefinition([
                 new InputArgument('add', InputArgument::REQUIRED, 'Add')
             ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $value = $input->getArgument('add');

        if (!empty($value)) {
            $bootstrap = new Bootstrap();
            $addAction = new AddAction($bootstrap);
            $addAction->setContent($value);
            $addAction->run();
        }

        $output->writeln($value);
    }
}
