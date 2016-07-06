<?php

namespace AppBundle\Twig;

use AppBundle\Twig\Functions\MatchFunction;
use AppBundle\Twig\Filters;
use AppBundle\Twig\Action;
use AppBundle\Twig\Table;

class AppTwigExtensions extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
//            new Filters\TitleFilter(),
//            new Filters\StatusFilter(),
//            new Filters\NiceUrlTitleFilter(),
        ];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new MatchFunction(),
            // action buttons
            new Action\BackActionButton(),
            new Action\RemoveActionButton(),
            new Action\CreateActionButton(),
            new Action\EditActionButton(),
            new Action\ViewActionButton(),
            // table buttons
            new Table\BackTableButton(),
            new Table\RemoveTableButton(),
            new Table\CreateTableButton(),
            new Table\EditTableButton(),
            new Table\ViewTableButton(),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_extensions';
    }
}
