<?php

namespace Kisphp\NewsletterBundle\Entity\Repository;

use AppBundle\Utils\Status;
use Doctrine\ORM\EntityRepository;

class SubscribersRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function getAvailableSubscribersQuery()
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.status = :status')
            ->setParameter('status', Status::ACTIVE)
        ;

        $query
            ->orderBy('a.id', 'DESC')
        ;

        return $query->getQuery();
    }

    /**
     * @param string $email
     *
     * @return \Doctrine\ORM\Query
     */
    public function getSubscriberByEmailQuery($email)
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

        return $query->getQuery();
    }
}
