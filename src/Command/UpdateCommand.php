<?php

namespace Task\Command;

use Herrera\Phar\Update\Manager;
use Herrera\Phar\Update\Manifest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{
    const MANIFEST = 'http://igor822.github.io/todo/manifest.json';

    protected function configure()
    {
        $this->setName('update')
             ->setDescription('Update todo app');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = new Manager(Manifest::loadFile(self::MANIFEST));
        $manager->update($this->getApplication()->getVersion(), true);
    }
}
