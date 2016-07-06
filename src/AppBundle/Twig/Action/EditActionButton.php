<?php

namespace AppBundle\Twig\Action;

use AppBundle\Twig\AbstractActionButton;

class EditActionButton extends AbstractActionButton
{

    protected function getFunctionName()
    {
        return 'editActionButton';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        return 'btn-edit';
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        return '<i class="fa fa-pencil-square-o"></i> ';
    }
}
