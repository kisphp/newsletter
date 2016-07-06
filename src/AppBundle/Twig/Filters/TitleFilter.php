<?php

namespace AppBundle\Twig\Filters;

use AppBundle\Twig\AbstractTwigFilterExtension;

class TitleFilter extends AbstractTwigFilterExtension
{
    /**
     * @return string
     */
    public function getFilterName()
    {
        return 'filterTitle';
    }

    /**
     * @return \Closure
     */
    public function getFilter()
    {
        return function ($text) {
            return stripslashes($text);
        };
    }
}
