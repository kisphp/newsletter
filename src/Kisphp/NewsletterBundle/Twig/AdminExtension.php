<?php

namespace Kisphp\NewsletterBundle\Twig;

//use Kisphp\Admin\MainBundle\Twig\Functions\GetBannerDimensionsFunction;
//use Kisphp\Admin\MainBundle\Twig\Functions\ToggleStatusFunction;
use Kisphp\NewsletterBundle\Twig\Functions\MatchFunction;

class AdminExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
//            new Filters\FilterTitleFilter(),
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
//            new Action\BackActionButton(),
//            new Action\RemoveActionButton(),
//            new Action\CreateActionButton(),
//            new Action\EditActionButton(),
//            new Action\ViewActionButton(),
//            // table buttons
//            new Table\BackTableButton(),
//            new Table\RemoveTableButton(),
//            new Table\CreateTableButton(),
//            new Table\EditTableButton(),
//            new Table\ViewTableButton(),

//            new GetBannerDimensionsFunction(),
//            new ToggleStatusFunction(),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'newsletter_extensions';
    }
}
