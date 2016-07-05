<?php

namespace Kisphp\Admin\MainBundle\Twig\Action;

use Kisphp\Admin\MainBundle\Twig\AbstractActionButton;

class CreateActionButton extends AbstractActionButton
{

    protected function getFunctionName()
    {
        return 'createActionButton';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        return 'btn-create';
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        return '<i class="fa fa-plus"></i> ';
    }
}
