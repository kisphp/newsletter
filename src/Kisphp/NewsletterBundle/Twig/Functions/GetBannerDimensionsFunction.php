<?php

namespace Kisphp\Admin\MainBundle\Twig\Functions;

use Kisphp\Admin\MainBundle\Twig\AbstractTwigFunction;

class GetBannerDimensionsFunction extends AbstractTwigFunction
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'getBannerDimensions';
    }

    /**
     * @return \Closure
     */
    protected function getFunction()
    {
        return function ($size) {
            $dimensions = explode('x', $size);

            return [
                'width' => (int) $dimensions[0],
                'height' => (int) $dimensions[1],
            ];
        };
    }
}
