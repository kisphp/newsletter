<?php

namespace Kisphp\Admin\MainBundle\Twig\Functions;

use Kisphp\Admin\MainBundle\Entity\ToggleableInterface;
use Kisphp\Admin\MainBundle\Twig\AbstractTwigFunction;
use Kisphp\Admin\MainBundle\Utils\Status;

class ToggleStatusFunction extends AbstractTwigFunction
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'toggleStatus';
    }

    /**
     * @return \Closure
     */
    protected function getFunction()
    {
        return function (ToggleableInterface $entity, $url) {

            $icon = ($entity->getStatus() === Status::ACTIVE) ? 'on' : 'off';

            $html = '<a href="#" class="status-toggle" data-id="' . $entity->getId() . '"'
                . ' id="status-' . $entity->getId() . '"'
                . ' data-placement="top"'
                . ' data-toggle="tooltip"'
                . ' data-original-title="Active / Inactive"'
                . ' data-url="' . $url . '">'
                . '<span class="fa fa-2x fa-toggle-'
                . $icon
                . '"></span></a>';

            return $html;
        };
    }
}
