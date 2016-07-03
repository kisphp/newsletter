<?php

namespace Kisphp\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KisphpNewsletterBundle:Default:index.html.twig');
    }
}
