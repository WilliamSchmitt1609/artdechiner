<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de votre adresse',
                'attr' => [
                    'placeholder' => 'Renseignez le nom de votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' =>'Renseignez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom de famille',
                'attr' => [
                    'placeholder' => 'Renseignez votre nom de famille'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Nom de votre entreprise',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Renseignez le nom de votre entreprise (facultatif)',
                    
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => 'Renseignez votre adresse'
                ]
            ])
            ->add('postalcode', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Renseignez votre code postal'
                ]
            ])
            ->add('mailbox', TextType::class, [
                'label' => 'Votre boite postale',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Renseignez votre boite postale (faculatatif)'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'attr' => [
                    'placeholder' => 'Renseignez votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                'attr' => [
                    'placeholder' => 'Renseignez votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Renseigner votre numéro de fix ou mobile'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter mon adresse',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
