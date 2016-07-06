<?php

namespace Kisphp\NewsletterBundle\Entity\Repository;

use AppBundle\Utils\Status;
use Doctrine\ORM\EntityRepository;
use Kisphp\NewsletterBundle\Entity\SubscribersEntity;

class SubscribersRepository extends EntityRepository
{
    /**
     * @return SubscribersEntity[]
     */
    public function getAvailableSubscribers()
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.status = :status')
            ->setParameter('status', Status::ACTIVE)
        ;

        $query
            ->orderBy('a.id', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * @param string $email
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @return SubscribersEntity|null
     */
    public function getSubscriberByEmail($email)
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.status > :status')
            ->setParameter('status', Status::DELETED)
            ->andWhere('a.email = :email')
            ->setParameter('email', $email)
        ;

        $query
            ->orderBy('a.id', 'DESC')
        ;

        return $query->getQuery()->getOneOrNullResult();
    }
}
