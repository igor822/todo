<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\AddAction;
use Task\Action\ToggleAction;
use Task\Bootstrap;

class TaskToggleCommand extends Command
{
    protected function configure()
    {
        $this->setName('toggle')
             ->setDescription('Toggle status of a task')
             ->setDefinition([
                 new InputArgument('toggle', InputArgument::REQUIRED, 'Toggle Task')
             ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $value = $input->getArgument('toggle');

        if (!empty($value)) {
            $bootstrap = new Bootstrap();
            $addAction = new ToggleAction($bootstrap);
            $addAction->setContent($value);
            $addAction->run();

            $value = 'Successful updated';
        }

        $output->writeln($value);
    }
}
