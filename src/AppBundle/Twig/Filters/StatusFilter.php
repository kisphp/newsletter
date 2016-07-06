<?php

namespace AppBundle\Twig\Filters;

use AppBundle\Twig\AbstractTwigFilterExtension;
use AppBundle\Utils\Status;

class StatusFilter extends AbstractTwigFilterExtension
{
    /**
     * @return string
     */
    public function getFilterName()
    {
        return 'status';
    }

    /**
     * @return \Closure
     */
    public function getFilter()
    {
        return function ($status) {
            return Status::getStatus($status);
        };
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            'is_safe' => ['html'],
        ];
    }
}
