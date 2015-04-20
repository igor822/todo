<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\AddAction;
use Task\Action\UpdateAction;
use Task\Bootstrap;

class TaskUpdateCommand extends Command
{
    protected function configure()
    {
        $this->setName('update')
             ->setAliases(['u'])
             ->setDescription('Add a new task')
             ->setDefinition([
                 new InputArgument('id', InputArgument::REQUIRED, 'Id of task'),
                 new InputArgument('value', InputArgument::REQUIRED, 'New value of task')
             ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $updateAction = new UpdateAction($bootstrap);

        $task = null;
        $id = $input->getArgument('id');
        if (!empty($id)) {
            $task = $updateAction->getTask($id);
            $updateAction->setId($id);
        }

        $value = $input->getArgument('value');
        if ($value !== null) {
            $updateAction->setContent($value);
            $updateAction->run();
        }
        $output->writeln('<info>Task successful updated</info>');
    }
}
