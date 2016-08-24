<?php

namespace AppBundle\Command\Setup;

use AppBundle\Entity\UserEntity;
use AppBundle\Utils\Status;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupAdminCommand extends ContainerAwareCommand
{
    const ADMIN_EMAIL = 'admin@example.com';
    const ADMIN_PASS = 'admin';

    protected function configure()
    {
        $this
            ->setName('setup:admin')
            ->setDescription('Install Admin for development use')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $admin = new UserEntity();
        $em = $this->getContainer()->get('doctrine')->getManager();

        $user = $em->getRepository('AppBundle:UserEntity')->find(1);

        if (null !== $user) {
            $output->writeln('<error>User already exists. Action denied!</error>');

            return;
        }

        $password = $this->getContainer()
            ->get('users.security.service')
            ->encodePassword($admin, self::ADMIN_PASS)
        ;

        $admin->setId(1);
        $admin->setEmail(self::ADMIN_EMAIL);
        $admin->setPassword($password);
        $admin->setStatus(Status::ACTIVE);
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setFirstName('Web');
        $admin->setLastName('Master');

        $em->persist($admin);
        $em->flush();

        $output->writeln('Created admin user with email: <info>' . self::ADMIN_EMAIL . '</info> and password: <info>' . self::ADMIN_PASS . '</info>');
    }
}
