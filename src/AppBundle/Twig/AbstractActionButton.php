<?php

namespace AppBundle\Twig;

use AppBundle\Utils\ButtonLink;

abstract class AbstractActionButton extends AbstractTwigFunction
{
    /**
     * @var string
     */
    protected $defaultClasses = 'btn btn-sm';

    /**
     * @return string
     */
    abstract protected function getButtonClass();

    /**
     * @return string
     */
    abstract protected function getIcon();

    /**
     * @return \Closure
     */
    protected function getFunction()
    {
        return function ($url, $title, $options = []) {
            $options[ButtonLink::BUTTON_CLASS] = $this->getButtonClass();
            $options[ButtonLink::BUTTON_ICON] = $this->getIcon();
            $options[ButtonLink::BUTTON_DEFAULT_CLASSES] = $this->defaultClasses;

            $btn = new ButtonLink($url, $title, $options);

            return $btn->generate();
        };
    }

    /**
     * return array;
     */
    public function getOptions()
    {
        return [
            'is_safe' => ['html'],
        ];
    }
}
