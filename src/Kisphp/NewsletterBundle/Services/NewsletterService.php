<?php

namespace Kisphp\NewsletterBundle\Services;

use AppBundle\Utils\Status;
use Doctrine\ORM\EntityManager;
use Finite\Loader\ArrayLoader;
use Finite\State\StateInterface;
use Finite\StateMachine\StateMachine;
use Kisphp\NewsletterBundle\Entity\NewsletterEntity;
use Symfony\Component\HttpFoundation\Request;

class NewsletterService
{
    const TRANSITION_SEND = 'send';
    const TRANSITION_SENT = 'sent';
    const TRANSITION_CANCEL = 'cancel';
    const TRANSITION_REACTIVATE = 'reactivate';

    const NEWSLETTER_ENTITY = 'KisphpNewsletterBundle:NewsletterEntity';

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
     * @param int $newsletterId
     *
     * @return NewsletterEntity|null|object
     */
    public function getNewsletterById($newsletterId)
    {
        return $this->em
            ->getRepository(self::NEWSLETTER_ENTITY)
            ->find($newsletterId)
        ;
    }

    /**
     * @param NewsletterEntity $entity
     *
     * @return NewsletterEntity
     */
    public function saveNewsletter(NewsletterEntity $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param NewsletterEntity $entity
     *
     * @return NewsletterEntity
     */
    public function deleteNewsletter(NewsletterEntity $entity)
    {
        $entity->setStatus(Status::DELETED);

        return $this->saveNewsletter($entity);
    }

    /**
     * @return array|\Kisphp\NewsletterBundle\Entity\NewsletterEntity[]
     */
    public function getPendingNewsletters()
    {
        return $this->em
            ->getRepository(self::NEWSLETTER_ENTITY)
            ->findBy([
                'state' => NewsletterEntity::STATE_PENDING,
            ])
        ;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryNewsletters()
    {
        return $this->em
            ->getRepository(self::NEWSLETTER_ENTITY)
            ->queryNewsletters()
        ;
    }

    /**
     * @return array
     */
    public function createNewsletterStateMachine()
    {
        $service = $this;

        return [
            'class' => 'NewsletterEntity',
            'states' => [
                'draft' => [
                    'type' => StateInterface::TYPE_INITIAL,
                    'properties' => [
                        'edit' => true,
                        'delete' => true,
                    ],
                ],
                'pending' => [
                    'type' => StateInterface::TYPE_NORMAL,
                    'properties' => [
                        'edit' => false,
                        'delete' => false,
                        'manual' => false,
                    ],
                ],
                self::TRANSITION_SENT => [
                    'type' => StateInterface::TYPE_FINAL,
                    'properties' => [
                        'edit' => false,
                        'delete' => false,
                    ],
                ],
                'canceled' => [
                    'type' => StateInterface::TYPE_NORMAL,
                    'properties' => [
                        'edit' => false,
                        'delete' => true,
                    ],
                ],
            ],
            'transitions' => [
                self::TRANSITION_SEND => [
                    'from' => ['draft'],
                    'to' => 'pending',
                ],
                self::TRANSITION_SENT => [
                    'from' => ['pending'],
                    'to' => self::TRANSITION_SENT,
                ],
                self::TRANSITION_CANCEL => [
                    'from' => ['draft', 'pending'],
                    'to' => 'canceled',
                ],
                self::TRANSITION_REACTIVATE => [
                    'from' => ['canceled'],
                    'to' => 'draft',
                ],
//                'reset' => [
//                    'from' => ['sent'],
//                    'to' => 'draft',
//                ],
            ],
            'callbacks' => [
                'after' => [
                    [
                        'to' => [],
                        'do' => function (NewsletterEntity $entity) use ($service) {
                            $service->saveNewsletter($entity);
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * @param NewsletterEntity $entity
     *
     * @throws \Finite\Exception\ObjectException
     *
     * @return StateMachine
     */
    public function getStateMachine(NewsletterEntity $entity)
    {
        $stateMachine = new StateMachine();
        $loader = new ArrayLoader($this->createNewsletterStateMachine());
        $loader->load($stateMachine);
        $stateMachine->setObject($entity);
        $stateMachine->initialize();

        return $stateMachine;
    }
}
