<?php

namespace Kisphp\Admin\MainBundle\Twig\Table;

use Kisphp\Admin\MainBundle\Twig\AbstractTableButton;

class CreateTableButton extends AbstractTableButton
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'createTableButton';
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
