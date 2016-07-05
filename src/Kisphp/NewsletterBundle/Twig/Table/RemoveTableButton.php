<?php

namespace Kisphp\Admin\MainBundle\Twig\Table;

use Kisphp\Admin\MainBundle\Twig\AbstractTableButton;

class RemoveTableButton extends AbstractTableButton
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'removeTableButton';
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
