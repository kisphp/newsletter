<?php

namespace AppBundle\Twig\Table;

use AppBundle\Twig\AbstractTableButton;

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
