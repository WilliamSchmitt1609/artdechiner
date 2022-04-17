<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre nom de famille'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Mail',
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre mail'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Veuillez créer un mot de passe'
                ]
            ])
            ->add('password_confirm', PasswordType::class, [
                'label' => 'Confirmez votre mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez créer un mot de passe'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Validez votre inscription'
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
