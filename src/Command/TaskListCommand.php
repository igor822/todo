<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Action\ListAction;
use Task\Bootstrap;
use Task\Component\ConsoleColor;
use Task\Constants\ConsoleColors;
use Task\Constants\StatusType;
use Task\Constants\UnicodeIcon;

class TaskListCommand extends Command
{
    protected function configure()
    {
        $this->setName('list')
             ->setAliases(['filter'])
             ->setDescription('List all tasks')
             ->addOption('--done', null, InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $listAction = new ListAction($bootstrap);

        if ($listAction->hasTask()) {
            $output->writeln("<info>There is no task now!</info>");
            return;
        }

        $filter = StatusType::TODO;
        if ($input->getOption('done')) {
            $filter = StatusType::DONE;
        }

        foreach ($listAction->printAllTasks(null, $filter) as $line) {
            $output->writeln($line);
        }
    }
}
