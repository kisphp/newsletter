<?php

namespace Kisphp\Admin\MainBundle\Twig\Action;

use Kisphp\Admin\MainBundle\Twig\AbstractActionButton;

class BackActionButton extends AbstractActionButton
{

    protected function getFunctionName()
    {
        return 'backActionButton';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        return 'btn-back';
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        return '<i class="fa fa-angle-double-left"></i> ';
    }
}
