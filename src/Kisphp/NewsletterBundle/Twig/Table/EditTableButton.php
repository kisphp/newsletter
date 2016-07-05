<?php

namespace Kisphp\Admin\MainBundle\Twig\Table;

use Kisphp\Admin\MainBundle\Twig\AbstractTableButton;

class EditTableButton extends AbstractTableButton
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'editTableButton';
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
