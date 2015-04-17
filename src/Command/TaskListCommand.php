<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
             ->setDescription('Add a new task')
             ->setDefinition([
                 new InputArgument('list', InputArgument::OPTIONAL, 'List')
             ])
             ->setHelp(<<<EOT
The <info>todo</info>
EOT
            );
    }

    private function printHashTag($content)
    {
        preg_match_all("/((?<=([#]))[A-Za-z]+)/", $content, $matches, PREG_PATTERN_ORDER);
        foreach ($matches[0] as $match) {
            $search = '#' . $match;
            $replace = ConsoleColor::printColor($search, 'light_yellow');
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrap = new Bootstrap();
        $listAction = new ListAction($bootstrap);

        $iconStatus = function($status) {
            $str = '';
            $color = '';
            switch ($status) {
                case StatusType::OPEN:
                    $str = UnicodeIcon::OPEN;
                    $color = 'red';
                    break;
                case StatusType::CLOSED:
                    $str = UnicodeIcon::CLOSED;
                    $color = 'green';
                    break;
            }

            return ConsoleColor::printColor(json_decode('"' . $str . '"'), $color);
        };

        $items = $listAction->run();
        foreach ($items as $item) {
            $output->writeln(
                sprintf(
                    "%s | %s | %s",
                    $item['id'],
                    $iconStatus($item['status']),
                    $this->printHashTag($item['content'])
                )
            );
        }
    }
}
