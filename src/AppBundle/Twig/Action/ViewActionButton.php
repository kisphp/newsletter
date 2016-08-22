<?php

namespace AppBundle\Twig\Action;

use AppBundle\Twig\AbstractActionButton;

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
