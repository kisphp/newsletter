<?php

namespace Kisphp\Admin\MainBundle\Twig\Table;

use Kisphp\Admin\MainBundle\Twig\AbstractTableButton;

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
