<?php

namespace AppBundle\Twig\Action;

use AppBundle\Twig\AbstractActionButton;

class RemoveActionButton extends AbstractActionButton
{
    protected function getFunctionName()
    {
        return 'removeActionButton';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        return 'btn-remove';
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        return '<i class="fa fa-trash-o"></i> ';
    }
}
