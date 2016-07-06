<?php

namespace Kisphp\NewsletterBundle\Entity\Repository;

use AppBundle\Utils\Status;
use Doctrine\ORM\EntityRepository;

class NewsletterRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryNewsletters()
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.status > :status')
            ->setParameter('status', Status::DELETED)
        ;

        $query
            ->orderBy('a.id', 'DESC')
        ;

        return $query;
    }
}
