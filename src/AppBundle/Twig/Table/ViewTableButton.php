<?php

namespace AppBundle\Twig\Table;

use AppBundle\Twig\AbstractTableButton;

class ViewTableButton extends AbstractTableButton
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'viewTableButton';
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
