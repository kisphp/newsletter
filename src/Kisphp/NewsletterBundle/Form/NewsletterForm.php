<?php

namespace Kisphp\NewsletterBundle\Form;

use Kisphp\Admin\MainBundle\Utils\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;

class NewsletterForm extends AbstractType
{
    const FIELD_SUBJECT = 'subject';
    const FIELD_STATUS = 'status';
    const FIELD_CONTENT = 'content';

    /**
     * @return string
     */
    public function getName()
    {
        return 'newsletter';
    }

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_SUBJECT, TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Required(),
                ],
            ])
            ->add(self::FIELD_STATUS, HiddenType::class, [
                'data' => Status::ACTIVE,
            ])
            ->add(self::FIELD_CONTENT, TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Required(),
                ],
                'attr' => [
                    'style' => 'height: 300px',
                ],
            ])
        ;
    }
}
