<?php

namespace AppBundle\Command\Setup;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallDevCommand extends ContainerAwareCommand
{
    const DOCTRINE_SCHEMA_DROP = 'doctrine:schema:drop';
    const SETUP_INSTALL = 'setup:install';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('setup:install-dev')
            ->setDescription('Will reset database and add Admin User')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dropDatabase($output);
        $this->runSetupInstall($output);
    }

    protected function runSetupInstall(OutputInterface $output)
    {
        $command = $this->getApplication()->find(self::SETUP_INSTALL);

        $arguments = [
            'command' => self::SETUP_INSTALL,
        ];

        $cmdInput = new ArrayInput($arguments);
        $command->run($cmdInput, $output);
    }

    /**
     * @param OutputInterface $output
     *
     * @throws \Exception
     */
    protected function dropDatabase(OutputInterface $output)
    {
        $command = $this->getApplication()->find(self::DOCTRINE_SCHEMA_DROP);

        $arguments = [
            'command' => self::DOCTRINE_SCHEMA_DROP,
            '--force' => true,
        ];

        $cmdInput = new ArrayInput($arguments);
        $command->run($cmdInput, $output);
    }
}
