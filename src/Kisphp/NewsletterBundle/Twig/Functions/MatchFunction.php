<?php

namespace Kisphp\NewsletterBundle\Twig\Functions;

use Kisphp\NewsletterBundle\Twig\AbstractTwigFunction;

class MatchFunction extends AbstractTwigFunction
{
    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'match';
    }

    /**
     * @return \Closure
     */
    protected function getFunction()
    {
        return function ($pattern, $string) {
            return preg_match('/' . $pattern . '/', $string);
        };
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [];
    }
}
