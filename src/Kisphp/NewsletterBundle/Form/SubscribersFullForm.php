<?php

namespace Kisphp\NewsletterBundle\Form;

use AppBundle\Utils\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;

class SubscribersFullForm extends AbstractType
{
    const FIELD_EMAIL = 'email';
    const FIELD_FIRST_NAME = 'first_name';
    const FIELD_LAST_NAME = 'last_name';
    const FIELD_STATUS = 'status';

    /**
     * @return string
     */
    public function getName()
    {
        return 'subscribers';
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_EMAIL, EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Required(),
                    new Email(),
                ],
            ])
            ->add(self::FIELD_FIRST_NAME, TextType::class)
            ->add(self::FIELD_LAST_NAME, TextType::class)
            ->add(self::FIELD_STATUS, ChoiceType::class, [
                'choices' => [
                    Status::ACTIVE => 'Active',
                    Status::INACTIVE => 'Inactive',
                ],
                'expanded' => true,
                'attr' => [
                    'class' => 'status-radio',
                ],
            ])
        ;
    }
}
