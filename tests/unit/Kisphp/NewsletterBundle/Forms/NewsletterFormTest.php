<?php

namespace tests\unit\Kisphp\NewsletterBundle\Forms;

use Codeception\Test\Unit;
use Codeception\Util\Stub;
use Kisphp\NewsletterBundle\Form\NewsletterForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @group form
 * @group newsletter
 */
class NewsletterFormTest extends Unit
{
    protected $builder;

    public function _before()
    {
        $this->builder = Stub::makeEmpty(
            FormBuilderInterface::class,
            [
                'add' => function() {
                    return $this;
                }
            ]
        );
    }

    public function test_form_name()
    {
        $form = new NewsletterForm();

        self::assertSame('newsletter', $form->getName());
    }

    public function test_form_configure_options()
    {
        $form = new NewsletterForm();

        $optionsResolver = Stub::make(
            OptionsResolver::class,
            [
                'setDefaults' => function($options){
                    $this->defaults = $options;
                }
            ]
        );

        $form->configureOptions($optionsResolver);
    }

    public function add()
    {
        return $this->builder;
    }

    public function test_form_build()
    {
        $form = new NewsletterForm();

        $form->buildForm($this->builder, []);
    }
}
