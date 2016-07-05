<?php

namespace Kisphp\Admin\MainBundle\Twig\Table;

use Kisphp\Admin\MainBundle\Twig\AbstractTableButton;

class BackTableButton extends AbstractTableButton
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'backTableButton';
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
