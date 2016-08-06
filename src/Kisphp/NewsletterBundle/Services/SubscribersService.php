<?php

namespace Kisphp\NewsletterBundle\Services;

use Doctrine\ORM\EntityManager;

class SubscribersService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getSubscribers()
    {
        return $this->em
            ->getRepository('KisphpNewsletterBundle:SubscribersEntity')
            ->getAvailableSubscribers()
        ;
    }

    /**
     * @param string $email
     *
     * @return \Kisphp\NewsletterBundle\Entity\SubscribersEntity|null
     */
    public function getSubscriberByEmail($email)
    {
        return $this->em
            ->getRepository('KisphpNewsletterBundle:SubscribersEntity')
            ->getSubscriberByEmail($email)
        ;
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function unsubscribeUserByEmail($email)
    {
        $entity = $this->getSubscriberByEmail($email);

        if ($entity === null) {
            return false;
        }

        $entity->setEmail($entity->getEmail() . '-usubscribed-' . uniqid());
        $this->em->persist($entity);
        $this->em->flush();

        return true;
    }
}
