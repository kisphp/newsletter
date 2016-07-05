<?php

namespace Kisphp\Admin\MainBundle\Twig\Filters;

use BaseBundle\Twig\AbstractTwigFilterExtension;

class FilterTitleFilter extends AbstractTwigFilterExtension
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
