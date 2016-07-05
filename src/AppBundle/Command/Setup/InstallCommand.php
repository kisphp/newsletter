<?php

namespace AppBundle\Command\Setup;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends ContainerAwareCommand
{
    const DOCTRINE_SCHEMA_UPDATE = 'doctrine:schema:update';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('setup:install')
            ->setDescription('Will Install application')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find(self::DOCTRINE_SCHEMA_UPDATE);

        $arguments = [
            'command' => self::DOCTRINE_SCHEMA_UPDATE,
            '--force' => true,
        ];

        $cmdInput = new ArrayInput($arguments);
        $command->run($cmdInput, $output);
    }
}
