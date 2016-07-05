<?php

namespace Kisphp\Admin\MainBundle\Twig\Action;

use Kisphp\Admin\MainBundle\Twig\AbstractActionButton;

class ViewActionButton extends AbstractActionButton
{

    protected function getFunctionName()
    {
        return 'viewActionButton';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        return 'btn-view';
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        return '<i class="fa fa-caret-right"></i> ';
    }
}
