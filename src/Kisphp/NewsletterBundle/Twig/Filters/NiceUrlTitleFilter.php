<?php

namespace Kisphp\Admin\MainBundle\Twig\Filters;

use BaseBundle\Twig\AbstractTwigFilterExtension;
use Kisphp\Admin\MainBundle\Utils\Strings;

class NiceUrlTitleFilter extends AbstractTwigFilterExtension
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
