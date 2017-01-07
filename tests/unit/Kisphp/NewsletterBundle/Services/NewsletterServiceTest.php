<?php

namespace tests\unit\Kisphp\NewsletterBundle\Services;

use AppBundle\Utils\Status;
use Codeception\Test\Unit;
use Codeception\Util\Stub;
use Doctrine\ORM\EntityManager;
use Kisphp\NewsletterBundle\Entity\NewsletterEntity;
use Kisphp\NewsletterBundle\Entity\Repository\NewsletterRepository;
use Kisphp\NewsletterBundle\Services\NewsletterService;

/**
 * @group NewsletterService
 * @group Newsletter
 */
class NewsletterServiceTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var NewsletterService
     */
    protected $service;

    protected function _before()
    {
        $newsletterRepository = Stub::makeEmpty(
            NewsletterRepository::class,
            [
                'find' => function ($i) {
                    return $i;
                },
            ]
        );
        $entityManager = Stub::makeEmpty(
            EntityManager::class,
            [
                'getRepository' => function () use ($newsletterRepository) {
                    return $newsletterRepository;
                },
                'persist' => function () {
                    return;
                },
                'flush' => function () {
                    return;
                },
            ]
        );

        $this->service = new NewsletterService($entityManager);
    }

    /**
     * @return NewsletterEntity
     */
    protected function createEntity()
    {
        return new NewsletterEntity();
    }

    public function test_save_newsletter()
    {
        $entity = $this->createEntity();

        $output = $this->service
            ->saveNewsletter($entity)
        ;

//        self::assertTrue(false);
        self::assertNotNull($output);
    }

    /**
     * @depends test_save_newsletter
     */
    public function test_get_newsletter_by_id()
    {
        $entity = $this->service
            ->getNewsletterById(1)
        ;

        self::assertEquals(1, $entity);
    }

    /**
     * @depends test_save_newsletter
     */
    public function test_delete_entity()
    {
        $entity = $this->createEntity();

        $output = $this->service
            ->deleteNewsletter($entity)
        ;

        self::assertEquals(Status::DELETED, $output->getStatus());
    }

    public function test_create_newsletter_state_machine_array()
    {
        $entity = $this->createEntity();
        $stateMachineRules = $this->service
            ->createNewsletterStateMachine()
        ;

        self::assertArrayHasKey('states', $stateMachineRules);
        $stateMachineRules['callbacks']['after'][0]['do']($entity);
    }

    public function test_get_state_machine()
    {
        $entity = $this->createEntity();

        $output = $this->service
            ->getStateMachine($entity)
        ;

        self::assertNotNull($output);
    }

    public function test_get_pending_newsletters()
    {
        $output = $this->service
            ->getPendingNewsletters()
        ;

        self::assertNull($output);
    }

    public function test_query_newsletters()
    {
        $output = $this->service
            ->queryNewsletters()
        ;

        self::assertNull($output);
    }
}
