<?php

namespace AppBundle\Twig\Filters;

use AppBundle\Twig\AbstractTwigFilter;
use AppBundle\Utils\Strings;

class NiceUrlTitleFilter extends AbstractTwigFilter
{
    /**
     * @return string
     */
    public function getFilterName()
    {
        return 'niceUrlTitle';
    }

    /**
     * @return \Closure
     */
    public function getFilter()
    {
        return function ($text, $separator = 'dash', $lowercase = true) {
            return Strings::niceUrlTitle($text, $separator, $lowercase);
        };
    }
}
