<?php

namespace Task\Action;

use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\OutputInterface;

class InitAction extends AbstractAction
{
    /**
     * @var DialogHelper
     */
    private $dialog;

    /**
     * @var OutputInterface
     */
    private $output;

    public function setDialog($dialog)
    {
        $this->dialog = $dialog;
    }

    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function run()
    {
        $message = "<comment>Please add the full path where do you want to store your tests:</comment>\n";
        $fileStorage = $this->dialog->ask($this->output, $message);

        do {
            $dirExists = true;
            if (!is_dir($fileStorage)) {
                $dirExists = false;
                $this->output->writeln('Path does not exists');
                $fileStorage = $this->dialog->ask($this->output, $message);
            }
        } while ($dirExists == false);

        $configuration = $this->getApplication()->getConfiguration();
        $configuration->addConfig(
            'file-storage',
            sprintf(
                "%s/%s",
                $fileStorage,
                'tasks.todo'
            )
        );
    }
}
