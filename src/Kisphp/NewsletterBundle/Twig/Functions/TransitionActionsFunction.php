<?php

namespace Kisphp\NewsletterBundle\Twig\Functions;

use Finite\StateMachine\StateMachineInterface;
use AppBundle\Twig\AbstractTwigFunction;
use Kisphp\NewsletterBundle\Services\NewsletterService;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\Translator;

class TransitionActionsFunction extends AbstractTwigFunction
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

        parent::__construct();
    }

    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'transitionActions';
    }

    /**
     * @return \Closure
     */
    protected function getFunction()
    {
        return function (StateMachineInterface $stateMachine) {
            $buttons = '';
            $transitions = $stateMachine->getTransitions();
            foreach ($transitions as $action) {
                if (!$stateMachine->can($action)) {
                    continue;
                }
                if (
                    $stateMachine->getCurrentState()->has('manual')
                    && $stateMachine->getCurrentState()->get('manual') === false
                    && $action !== NewsletterService::TRANSITION_CANCEL
                ) {
                    continue;
                }
                $buttons .= $this->createButton($action);
            }

            return $buttons;
        };
    }

    /**
     * @param string $action
     *
     * @return string
     */
    protected function createButton($action)
    {
        $class = 'btn-success';
        if (preg_match('/(cancel|delete|remove)/', $action)) {
            $class = 'btn-danger';
        }
        if (preg_match('/send/', $action)) {
            $class = 'btn-primary';
        }

        $button = '<a href="#"';
        $button .= ' class="btn btn-xs ' . $class . ' trigger-state"';
        $button .= ' data-transition="' . $action . '"';
        $button .= ' data-url="' . $this->router->generate('newsletter_trigger') . '"';
        $button .= '>';
        $button .= $this->translator->trans($action);
        $button .= '</a> ';

        return $button;
    }
}
