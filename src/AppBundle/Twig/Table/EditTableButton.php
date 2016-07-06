<?php

namespace AppBundle\Twig\Table;

use AppBundle\Twig\AbstractTableButton;

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
