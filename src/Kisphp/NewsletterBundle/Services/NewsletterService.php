<?php

namespace Kisphp\NewsletterBundle\Services;

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
            ->getRepository('KisphpNewsletterBundle:NewsletterEntity')
            ->find($newsletterId)
        ;
    }

    /**
     * @return array|\Kisphp\NewsletterBundle\Entity\NewsletterEntity[]
     */
    public function getPendingNewsletters()
    {
        return $this->em
            ->getRepository('KisphpNewsletterBundle:NewsletterEntity')
            ->findBy([
                'state' => NewsletterEntity::STATE_PENDING,
            ])
        ;
    }

    /**
     * @param Request $request
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryNewsletters(Request $request)
    {
        return $this->em
            ->getRepository('KisphpNewsletterBundle:NewsletterEntity')
            ->queryNewsletters()
        ;
    }

    /**
     * @return array
     */
    public function createNewsletterStateMachine()
    {
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
                        'do' => function (NewsletterEntity $entity) {
                            $this->em->persist($entity);
                            $this->em->flush();
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
