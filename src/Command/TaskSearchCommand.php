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

class TaskSearchCommand extends Command
{
    protected function configure()
    {
        $this->setName('search')
             ->setDescription('Search hash tags in all tasks')
             ->addArgument('query', InputArgument::REQUIRED, 'Search');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $listAction = new ListAction($bootstrap);

        $query = $input->getArgument('query');
        $items = $listAction->printAllTasks($query);
        if (count($items) == 0) {
            $output->writeln("<info>There is no founded tasks!</info>");
            return;
        }

        foreach ($items as $line) {
            $output->writeln($line);
        }
    }
}
