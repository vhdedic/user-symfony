<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-input border border-black block w-full my-4 rounded-md'
            ],
            'label_attr' => [
                'class' => 'font-extrabold'
            ]
        ])
        ->add('username', TextType::class, [
            'attr' => [
                'class' => 'form-input border border-black block w-full my-4 rounded-md'
            ],
            'label_attr' => [
                'class' => 'font-extrabold'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'required' => true,
            'first_options' => [
                'label' => 'Password',
                'attr' => [
                    'class' => 'form-input border border-black block w-full my-4 rounded-md'
                ],
                'label_attr' => [
                    'class' => 'font-extrabold'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 12,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new PasswordStrength(),
                    new NotCompromisedPassword(),
                ],
            ],
            'second_options' => [
                'label' => 'Repeat Password',
                'attr' => [
                    'class' => 'form-input border border-black block w-full my-4 rounded-md'
                ],
                'label_attr' => [
                    'class' => 'font-extrabold'
                ]
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
