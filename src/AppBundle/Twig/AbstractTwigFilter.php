<?php

namespace AppBundle\Twig;

abstract class AbstractTwigFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            $this->getFunctionName(),
            $this->getFilter(),
            $this->getOptions()
        );
    }

    /**
     * @return string
     */
    abstract protected function getFunctionName();

    /**
     * @return callable
     */
    abstract protected function getFilter();

    /**
     * return array;
     */
    protected function getOptions()
    {
        return [
            'is_safe' => ['html'],
        ];
    }
}
