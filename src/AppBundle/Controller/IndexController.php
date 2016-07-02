<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Template()
 */
class IndexController extends Controller
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}
