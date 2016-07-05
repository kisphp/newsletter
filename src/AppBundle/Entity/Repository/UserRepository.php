<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Utils\Status;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $username
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @return mixed
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->andWhere('u.status = :status')
            ->andWhere('u.roles = :roles')
            ->setParameter('email', $username)
            ->setParameter('status', Status::ACTIVE)
            ->setParameter('roles', 'ROLE_USER')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
