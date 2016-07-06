<?php

namespace Kisphp\NewsletterBundle\Twig;

use Kisphp\NewsletterBundle\Twig\Functions\TransitionActionsFunction;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class NewsletterExtensions extends \Twig_Extension
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param Router $router
     * @param Translator $translator
     */
    public function __construct(Router $router, Translator $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
        ];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TransitionActionsFunction($this->router, $this->translator),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'newsletter_extensions';
    }
}
