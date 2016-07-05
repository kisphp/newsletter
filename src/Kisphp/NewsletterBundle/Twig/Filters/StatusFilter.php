<?php

namespace Kisphp\Admin\MainBundle\Twig\Filters;

use BaseBundle\Twig\AbstractTwigFilterExtension;
use Kisphp\Admin\MainBundle\Utils\Status;

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
