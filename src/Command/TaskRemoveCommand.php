<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\RemoveAction;
use Task\Bootstrap;

class TaskRemoveCommand  extends Command
{
    protected function configure()
    {
        $this->setName('remove')
             ->setDescription('Remove a task')
             ->setDefinition([
                 new InputArgument('remove', InputArgument::OPTIONAL)
             ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();

        $value = $input->getArgument('remove');
        if (!empty($value)) {
            $removeAction = new RemoveAction($bootstrap);
            $removeAction->setId($value);
            $removeAction->run();
        }

        $output->writeln('<info>Task #'. $value .' successful removed</info>');
    }
}
