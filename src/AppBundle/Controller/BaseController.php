<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseController extends Controller implements ContainerAwareInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);

        $this->em = $this->getDoctrine()->getManager();
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function trans($text)
    {
        return $this->get('translator')->trans($text);
    }
}
