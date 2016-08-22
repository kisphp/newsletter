<?php

namespace Kisphp\NewsletterBundle\Controller;

use AppBundle\Controller\BaseController;
use AppBundle\Utils\Status;
use Kisphp\NewsletterBundle\Entity\NewsletterEntity;
use Kisphp\NewsletterBundle\Form\NewsletterForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Template()
 */
class NewslettersController extends BaseController
{
    const ROWS_PER_PAGE = 30;

    /**
     * @param Request $request
     *
     * @throws \Finite\Exception\StateException
     *
     * @return JsonResponse
     */
    public function changeStateAction(Request $request)
    {
        $idNewsletter = $request->request->getInt('id');
        $newState = $request->request->get('transition');

        $newsletterService = $this->get('admin.newsletter.service');
        $entity = $newsletterService->getNewsletterById($idNewsletter);

        $sm = $newsletterService->getStateMachine($entity);

        if (!$sm->can($newState)) {
            return new JsonResponse([
                'code' => '1',
            ]);
        }

        $sm->apply($newState);

        return new JsonResponse([
            'code' => 200,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $query = $this->get('admin.newsletter.service')
            ->queryNewsletters($request)
        ;

        $pagination = $this->get('knp_paginator');
        $entities = $pagination->paginate(
            $query,
            $request->query->getInt('page', 1),
            self::ROWS_PER_PAGE
        );

        $items = $entities->getItems();
        $stateObjects = [];

        $newsletterService = $this->get('admin.newsletter.service');
        foreach ($items as $item) {
            $stateObjects[] = $newsletterService->getStateMachine($item);
        }

        return [
            'items' => $stateObjects,
            'pagination' => $entities,
        ];
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function previewAction(Request $request, $id)
    {
        $entity = $this->get('admin.newsletter.service')->getNewsletterById($id);
        $email = $request->request->get('email');

        $result = $this->get('kisphp_mail_factory')
            ->createMailMessage('Newsletter', [
                'to_email' => $email,
                'to_name' => $email,
                'subject' => $entity->getSubject(),
                'content' => $entity->getContent(),
            ])
            ->send()
        ;

        return new JsonResponse([
            'sent' => (bool) $result,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function removeActionAction(Request $request)
    {
        $entityId = $request->request->getInt('id');
        $listingUrl = $this->generateUrl('adm_newsletter_list');

        $newsletterService = $this->get('admin.newsletter.service');
        $entity = $newsletterService->getNewsletterById($entityId);

        if ($entity) {
            $newsletterService->deleteNewsletter($entity);

            return new JsonResponse([
                'code' => Response::HTTP_OK,
                'entity_id' => $entityId,
                'list_url' => $listingUrl,
            ]);
        }

        return new JsonResponse([
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'Object not found',
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->get('admin.newsletter.service')
            ->getNewsletterById($id)
        ;

        if (!$entity) {
            $entity = new NewsletterEntity();
        }

        $newsletterService = $this->get('admin.newsletter.service');
        $stateObjects = $newsletterService->getStateMachine($entity);

        $editForm = $this->createNewsletterForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $newsletterService->saveNewsletter($entity);

            return $this->redirect(
                $this->generateUrl(
                    'adm_newsletter_edit',
                    [
                        'id' => (int) $entity->getId()
                    ]
                )
            );
        }

        return [
            'entity' => $entity,
            'form' => $editForm->createView(),
            'stateMachine' => $stateObjects,
        ];
    }

    /**
     * @param NewsletterEntity $entity
     *
     * @return \Symfony\Component\Form\Form
     */
    public function createNewsletterForm(NewsletterEntity $entity)
    {
        $form = $this->createForm(
            new NewsletterForm(),
            $entity,
            [
                'method' => 'PUT',
            ]
        );

        return $form;
    }
}
